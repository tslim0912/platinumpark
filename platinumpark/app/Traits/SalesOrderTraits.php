<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Traits;

use App\User;
use App\Delivery;
use App\SalesItem;
use App\SalesOrder;
use App\Network;
use App\NetworkMethod;
use Carbon\Carbon;

/**
 *
 * @author ETC
 */
trait SalesOrderTraits {

    public function calculateMonthlyIncentive($trees) {
        $networkMethod = NetworkMethod::where("type", "level")
                ->orderBy("value", "asc")
                ->get();

        $records = [];

        foreach ($networkMethod as $method) {
            $records = $this->getNetworkUser($trees, $method, $records);
        }

        $objectRecords = [];
        foreach ($records as $key => $record) {
            $record_list_of_user = $record["list_of_user"];
            foreach ($record_list_of_user as $key_list => $list_of_user) {
                $incentive = $total_retail_price = $total_retail_price_incentive = $incentive_total = 0;

                $objectRecords[$key][$key_list] = [];

                $sales = $this->getSalesItemByUserIDListAndStartEndDate($list_of_user["user"], $this->start_date, $this->end_date);

                if ($sales->count() > 0) {
                    foreach ($sales as $sale) {
                        $total_retail_price += _standardNumberFormat(($sale->amount * $sale->quantity));
                    }

                    $incentive = (int) $list_of_user["value"];

                    $total_retail_price_incentive = $total_retail_price * ($incentive / 100);
                }

                $objectRecords[$key][$key_list] = array_merge($objectRecords[$key][$key_list], [
                    "incentive" => $incentive,
                    "total_retail_price" => $total_retail_price,
                    "total_retail_price_incentive" => _standardNumberFormat($total_retail_price_incentive)
                ]);
            }
        }

        return $objectRecords;
    }

    public function contributeIncentiveV2(User $users, $start_date, $end_date) {
        $contributors = [];

        $salesOrders = SalesOrder::whereBetween("created_at", [$start_date, $end_date])
                ->whereHas("salesNetwork", function ($query) use ($users) {
                    $query->where("upline_id", $users->id);
                })
                ->whereHas("salesDelivery.delivery", function ($query) {
                    $query->where("status", ">", 0);
                })
                ->whereHas("salesDelivery.delivery.payment", function ($query) {
                    $query->where("status", 1);
                })
                ->get();

        foreach ($salesOrders as $key => $salesOrder) {
            $user = $salesOrder->user;
            $item = $salesOrder->salesItem;
            $salesNetwork = $salesOrder->salesNetwork;
            $network = $salesNetwork->network;

            $incentive = (int) (($salesNetwork->value === 0.00) ? $network->value : $salesNetwork->value);
            $total_retail_price = $item->amount * $item->quantity;
            $total_retail_price_incentive = $total_retail_price * ($incentive / 100);

            $contributors = array_merge($contributors, [
                [
                    "id" => $user->id,
                    "fullname" => $user->fullname,
                    "incentive" => $incentive,
                    "incentive_group" => $network->name,
                    "total_retail_price" => _standardNumberFormat($total_retail_price),
                    "total_retail_price_incentive" => _standardNumberFormat($total_retail_price_incentive),
                ]
            ]);
        }

        return $contributors;
    }

    public function contributeIncentive($downlines, $user, $start_date, $end_date) {
        $downline = [
            [
                "no" => 1,
                "id" => $user->id,
                "fullname" => $user->fullname,
                "level" => 0,
                "personal_total_sales" => $this->getPersonalMonthSales($user->id),
                "next_level" => 1,
                "child" => $downlines
            ]
        ];

        $networkMethod = NetworkMethod::where("type", "level")
                ->orderBy("value", "asc")
                ->get();

        $records = [];

        foreach ($networkMethod as $method) {
            $records = $this->getNetworkUser($downline, $method, $records);
        }

        $contributors = [];
        foreach ($records as $key => $record) {
            $record_list_of_user = $record["list_of_user"];
            foreach ($record_list_of_user as $key_list => $list_of_user) {
                $incentive = !empty($list_of_user["value"]) ? $list_of_user["value"] : 0;
                $incentive_group = $key_list;

                $user_list = $list_of_user["user"];
                $user_detail_list = $list_of_user["details"];

                foreach ($user_list as $key_user_list => $user) {
                    $total_retail_price_incentive = $total_retail_price = 0;

                    $sales = $this->getSalesItemByUserIDAndStartEndDate($user, $start_date, $end_date);

                    if ($sales->count() > 0) {
                        foreach ($sales as $sale) {
                            $total_retail_price += _standardNumberFormat(($sale->amount * $sale->quantity));
                        }

                        $incentive = (int) $list_of_user["value"];

                        $total_retail_price_incentive = $total_retail_price * ($incentive / 100);

                        $contributors = array_merge($contributors, [
                            [
                                "id" => $user_detail_list[$key_user_list]["id"],
                                "fullname" => $user_detail_list[$key_user_list]["fullname"],
                                "incentive" => $incentive,
                                "incentive_group" => $incentive_group,
                                "total_retail_price" => $total_retail_price,
                                "total_retail_price_incentive" => $total_retail_price_incentive
                            ]
                        ]);
                    }
                }
            }
        }

        return $contributors;
    }

    public function getDownline($user_id, $downline = [], $max = 0) {
        if ($max > config("global.member_network_max_level")) {
            return $downline;
        }

        $userDetails = User::where("status", 1)
                ->whereHas("userDetails", function ($query) use ($user_id) {
                    $query->where("referral_id", $user_id);
                })
                ->get();

        if (empty($userDetails)) {
            return $downline;
        }

        $no = 1;

        foreach ($userDetails as $key => $details) {
            $downline[$key]["no"] = $no;
            $downline[$key]["id"] = $details->id;
            $downline[$key]["fullname"] = $details->fullname;
            $downline[$key]["level"] = $max + 1;
            $downline[$key]["next_level"] = $max + 2;
            $downline[$key]["personal_total_sales"] = $this->getPersonalMonthSales($details->id);
            $downline[$key]["child"] = [];
            $child = $this->getDownline($downline[$key]["id"], [], $downline[$key]["level"]);

            if (!empty($child)) {
                $downline[$key]["child"] = array_merge($downline[$key]["child"], $child);
            }
            $no++;
        }

        return $downline;
    }

    public function getPersonalMonthSales($user_id) {

        $deliveries = $this->getSalesOrderFromDeliveryByUserID($user_id);

        $product_total = 0;

        foreach ($deliveries as $delivery) {
            $salesDeliveries = $delivery->salesDelivery;
            foreach ($salesDeliveries as $salesDelivery) {
                $item = $salesDelivery->salesOrder->getItem();
                if (!empty($item)) {
                    //$product_total += $item->quantity * $item->amount;
                    $product_total += $item->total;
                }
            }
        }

        return _standardNumberFormat($product_total);
    }

    public function getSalesOrderFromDeliveryByUserID($user_id) {

        $start_date = Carbon::now()->startOfMonth()->toDateTimeString();
        $end_date = Carbon::now()->endOfMonth()->toDateTimeString();

        $delivery = Delivery::where("status", ">", 0)
                ->with([
                    "salesDelivery.salesOrder" => function ($query) use ($user_id, $start_date, $end_date) {
                        $query->where("created_by", $user_id)
                        ->whereBetween("created_at", [$start_date, $end_date]);
                    }
                ])
                ->whereHas("salesDelivery.salesOrder.salesItem", function ($query) use ($user_id) {
                    $query->where("created_by", $user_id);
                })
                ->whereHas("salesDelivery.salesOrder.salesShipping", function ($query) use ($user_id) {
                    $query->where("users_id", $user_id)->where("created_by", $user_id);
                })
                ->whereHas("payment", function ($query) {
                    $query->where("status", 1);
                })
                ->get();

        return $delivery;
    }

    public function getSalesItemByUserIDListAndStartEndDate($user_id_list, $start_date, $end_date) {
        $salesItem = SalesItem::whereIn("created_by", $user_id_list)
                ->whereBetween("created_at", [$start_date, $end_date])
                ->whereHas("salesOrder.salesDelivery.delivery", function ($query) {
                    $query->where("status", ">", 0);
                })
                ->whereHas("salesOrder.salesDelivery.delivery.payment", function ($query) {
                    $query->where("status", 1);
                })
                ->get();

        return $salesItem;
    }

    public function getSalesItemByUserIDAndStartEndDate($user_id, $start_date, $end_date) {
        $salesItem = SalesItem::where("created_by", $user_id)
                ->whereBetween("created_at", [$start_date, $end_date])
                ->whereHas("salesOrder.salesDelivery.delivery", function ($query) {
                    $query->where("status", ">", 0);
                })
                ->whereHas("salesOrder.salesDelivery.delivery.payment", function ($query) {
                    $query->where("status", 1);
                })
                ->get();

        return $salesItem;
    }

    public function getNetworkUser($trees, $method, $records = []) {
        foreach ($trees as $tree) {
            if (!empty($tree["next_level"]) && _eq($tree["next_level"], $method->value, TRUE)) {
                $key = "level_" . $method->value;
                $count = count($tree["child"]);

                $list_of_user = (!empty($records[$key]["list_of_user"])) ? $records[$key]["list_of_user"] : [];
                $total = (!empty($records[$key]["total_user"]) ? $records[$key]["total_user"] : 0) + $count;

                for ($i = 0; $i < $count; $i++) {
                    $incentive = $this->getNetwork($tree["child"][$i]["no"], $method);
                    if (empty($list_of_user[$incentive->name])) {
                        $list_of_user = array_merge($list_of_user, [
                            $incentive->name => [
                                "value" => (!empty($incentive->value)) ? (int) $incentive->value : 0,
                                "user" => [],
                                "details" => []
                            ]
                        ]);
                    }
                    $list_of_user[$incentive->name]["user"] = array_merge($list_of_user[$incentive->name]["user"], [
                        $tree["child"][$i]["id"]
                    ]);

                    $newTree = $tree["child"][$i];
                    unset($newTree["child"]);
                    $list_of_user[$incentive->name]["details"] = array_merge($list_of_user[$incentive->name]["details"], [
                        $newTree
                    ]);
                }

                $records = array_merge($records, [
                    $key => [
                        "total_user" => $total,
                        "list_of_user" => $list_of_user
                    ]
                ]);
            }
            $records = $this->getNetworkUser($tree["child"], $method, $records);
        }

        return $records;
    }

    private function getNetwork($value, $method) {
        return Network::whereHas("networkMethod", function($query) use ($method) {
                            $query->where("value", $method->value);
                        })
                        ->whereRaw("? BETWEEN `min` AND `max`", [$value])
                        ->orWhereRaw("? > `min` AND is_max = ?", [$value, 1])
                        ->first();
    }

    private function getDiscount($discount_quantity) {
        return Discount::whereRaw("? BETWEEN `min` AND `max`", [$discount_quantity])
                        ->orWhereRaw("`min` <= ? AND is_max = ?", [$discount_quantity, 1])
                        ->whereHas("discountMethod", function($query) {
                            $query->where("name", "percent");
                        })
                        ->first();
    }

    private function getExistingQuantity($user_id) {
        // find existing sales items
        return (!empty($user_id)) ? (int) SalesItem::where("created_by", $user_id)
                        ->sum("quantity") : 0;
    }

}

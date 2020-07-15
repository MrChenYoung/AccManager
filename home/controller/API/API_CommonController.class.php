<?php

namespace home\controller\API;

use admin\controller\API\API_AttachmentController;
use admin\controller\API\API_BaseController;
use framework\tools\DatabaseDataManager;

class API_CommonController extends API_BaseController
{
    // 获取前台账号列表
    public function loadHomeAccountLists(){
        // 分类id
        // id
        if (!isset($_GET["id"])){
            echo $this->failed("需要id参数");
            die;
        }
        $catId = $_GET["id"];

        // 获取分类数据
        $catData = $this->loadCategory($catId);
        // 获取每个平台数据
        if (key_exists("platform_list",$catData)){
            $platIdLists = $catData["platform_list"];
            if (strlen($platIdLists) > 0){
                $platIdLists = explode(",",$platIdLists);
                $platLists = [];
                $platSortArray = [];
                foreach ($platIdLists as $platId) {
                    $platData = $this->loadPlatform($platId);
                    // 获取账号列表
                    if (key_exists("acc_list",$platData)){
                        $accIdLists = $platData["acc_list"];
                        $accLists = [];
                        $sortData = [];
                        if (strlen($accIdLists) > 0){
                            $accIdLists = explode(",",$accIdLists);
                            foreach ($accIdLists as $accId) {
                                $accData = $this->loadAccount($accId);
                                $accData["plat_name"] = $platData["plat_name"];
                                // 查询是否有附件
                                $attachmentData = (new API_AttachmentController())->getAttachmentLists($accId,"acc_account");
                                $attachmentData = array_key_exists("data",$attachmentData) ? $attachmentData["data"] : [];
                                $hasAttachment = count($attachmentData) > 0 ? true : false;
                                $accData["hasAttachment"] = $hasAttachment;
                                $accLists[] = $accData;
                                $sortData[] = $accData["sort"];
                            }
                        }
                        // 按照sort排序
                        array_multisort($sortData, SORT_ASC, $accLists);
                        $platData["acc_list"] = $accLists;
                    }
                    $platLists[] = $platData;
                    $platSortArray[] = $platData["sort"];
                }
                // 按照sort排序
                array_multisort($platSortArray, SORT_ASC, $platLists);
                $catData["platform_list"] = $platLists;
            }
        }

        echo $this->success($catData);
    }

    // 获取指定分类数据
    private function loadCategory($catId){
        $res = DatabaseDataManager::getSingleton()->find("acc_category",["id"=>$catId]);
        if ($res && count($res) > 0){
            return $res[0];
        }else {
            return [];
        }
    }

    // 获取指定平台数据
    private function loadPlatform($platId){
        $res = DatabaseDataManager::getSingleton()->find("acc_platform",["id"=>$platId]);
        if ($res && count($res) > 0){
            return $res[0];
        }else {
            return [];
        }
    }

    // 获取指定账号数据
    private function loadAccount($accId){
        $res = DatabaseDataManager::getSingleton()->find("acc_account",["id"=>$accId]);
        if ($res && count($res) > 0){
            return $res[0];
        }else {
            return [];
        }
    }

    // 获取备注
    public function loadAccountRemark(){
        // id
        if (!isset($_GET["id"])){
            echo $this->failed("需要id参数");
            die;
        }
        $accId = $_GET["id"];

        $res = DatabaseDataManager::getSingleton()->find("acc_account",["id"=>$accId],["remark"]);
        if ($res && count($res) > 0){
            $remark = $res[0]["remark"];
            $this->success($remark);
        }else {
            echo $this->failed("获取备注失败");
        }
    }
}
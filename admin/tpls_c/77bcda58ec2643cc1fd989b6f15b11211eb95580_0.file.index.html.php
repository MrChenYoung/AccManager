<?php
/* Smarty version 3.1.30, created on 2020-06-11 09:50:39
  from "/Users/mrchen/Desktop/www/PhpProjects/AccountManager/admin/view/passwd/index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ee1fe6fe66ec9_38557797',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '77bcda58ec2643cc1fd989b6f15b11211eb95580' => 
    array (
      0 => '/Users/mrchen/Desktop/www/PhpProjects/AccountManager/admin/view/passwd/index.html',
      1 => 1591869016,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout.html' => 1,
  ),
),false)) {
function content_5ee1fe6fe66ec9_38557797 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20156454935ee1fe6fe63de2_60302833', "myStyles");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20810211585ee1fe6fe652d0_53844262', "scriptCode");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16893136525ee1fe6fe666e7_47957029', "content");
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:layout.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "myStyles"} */
class Block_20156454935ee1fe6fe63de2_60302833 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<style type="text/css">
    .aw-content-wrap .icon {
        background-color: #393D49;
        margin-right: 10px;
    }

    .layui-table thead th{
        text-align: center;
        font-weight: bold;
    }

    .add-category-box {
        background-color: rgba(0,0,0,0.7);
        width: 100%;
        height: 1000px;
        margin: 0 auto;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 500;
        display: none;
    }

    .add-category-container {
        width: 800px;
        height: 300px;
        background-color: #FFF;
        margin: 100px auto;
        padding: 10px;
        border-radius: 2px;
        position: relative;
    }


    .layui-field-title{
        width: 800px;
    }

    .layui-form-select dl dd.layui-this {
        background-color: #393D49;
    }

    .layui-form-item .cat-name {
        width: 250px;
    }

    .layui-input-inline .layui-btn {
        color: #e6e6e6
    }

    .icons-box {
        width: 700px;
        height: 100px;
        overflow-x: hidden;
        overflow-y: scroll;
        margin-bottom: 10px;
    }

    .icons-box ul {
        width: 700px;
        height: 200px;
        padding: 5px;
    }

    .icons-box ul li {
        width: 20px;
        height: 20px;
        float: left;
        cursor: pointer;
        color: #e6e6e6;
        margin: 5px;
    }

    .icons-box ul li:hover {
        color: #393D49;
    }

    .icons-box ul li i {
        font-size: 18px;
    }

    .btns-box {
        width: 146px;
        position: absolute;
        right: 10px;
        bottom: 20px;
    }

    .btns-box .confirm-btn{
        background-color: #393D49;
    }

    .pass-view-input {
        max-width: 98px;
        border: none;
        background-color: transparent;
    }

    .pass-view-input:hover {
        background-color: transparent;
    }

    #acc_table .translation-icon,#acc_table .translation-icon{
        background-color: transparent;
        color: #bfbfbf;
        cursor: pointer;
        font-size: 18px;
        margin: 0;
    }

    #acc_table .translation-icon:hover,#acc_table .translation-icon:hover{
        color: #393D49;
    }

    .pass-view-input {
        display: inline-block;
        margin-right: 5px;
    }

    .pass-view-input::selection{
        background-color: transparent;
    }

    .real-pass{
        width: 30px;
        height: 30px;
        background-color: transparent;
        color: transparent;
        margin: 0;
        padding: 0;
        border: none;
    }

    .real-pass::selection{
        color: transparent;
        background-color: transparent;
    }

</style>
<?php
}
}
/* {/block "myStyles"} */
/* {block "scriptCode"} */
class Block_20810211585ee1fe6fe652d0_53844262 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
    // 密码描述
    var passDesc = '';
    // 密码值
    var passValue = "";
    // 安全级别
    var passLevel = '';
    // 修改的密码id
    var editPassId = "";

    $(document).ready(function () {
        // 设置边栏服务器信息选中状态
        $("#pass_manager").addClass("active");

        // 监听输入描述信息
        var descInput = $("#pass_desc");
        descInput.bind("input propertychange", function (event) {
            passDesc = descInput.val();
        });
        // 监听输入密码
        var passVInput = $("#pass_value");
        passVInput.bind("input propertychange", function (event) {
            passValue = passVInput.val();
        });

        // 监听密码安全级别选择
        layui.use('form',function () {
            var form = layui.form;
            form.on('select(pass-level)', function(data){
                // 选择的密码安全级别
                passLevel = data.value;
            });
        });

        // 请求账号列表
        loadPassList();
    });

    // 获取账号列表
    function loadPassList() {
        var url = baseUrl + "/admin?c=API_PassManager&a=loadPassList";
        get(url,function (data) {
            // 创建密码列表
            createPassDom(data.data);
        },false);
    }

    // 添加密码
    function addData() {
        isEdit = false;
        passDesc = "";
        passValue = "";
        passLevel = "";
        // 显示添加界面
        showEditCatCover();
    }

    // 创建密码列表
    function createPassDom(data) {
        var dom = "";
        for(var i = 0; i < data.length; i++){
            var passData = data[i];
            var passLevel = parseInt(passData["pass_level"]);
            var levelDes = "";
            switch (passLevel) {
                case 1:
                    levelDes = "低";
                    break;
                case 2:
                    levelDes = "中";
                    break;
                case 3:
                    levelDes ="高";
                    break;
                case 4:
                    levelDes = "最高";
                    break;
                default:
                    levelDes = "其他";
                    break;
            }

            dom += '<tr><td>'+ passData["pass_desc"] +'</td>';
            dom += '<td><input pass="'+ passData["passwd"] +'" readonly="readonly" type="password" class="layui-input pass-view-input" value="'+ passData["passwd"] +'">';
            dom += '<i title="查看" passId="'+ passData["id"] +'" onclick="previewPass(this)" class="iconfont icon-Xtubiao-chakan translation-icon"></i><i title="复制" passId="'+ passData["id"] +'" id="copy_btn" onclick="copyPass(this)" class="icon icon-reply translation-icon"></i><input class="real-pass" type="text" id="real_pass_'+ passData["id"] +'"></td>';
            dom += '<td>'+ levelDes +'</td>';
            dom += '<td><i onclick="editPass(this)" passId="'+ passData["id"] +'" style="cursor: pointer" class="icon icon-edit"></i>';
            dom += '<i passId="'+ passData["id"] +'" onclick="deletePass(this)" style="cursor: pointer" class="icon icon-trash"></i></td></tr>';
        }

        $("tbody").html(dom);
    }

    // 查看密码
    function previewPass(obj) {
        var $this = $(obj);
        var passId = $this.attr("passId");
        var input = $this.parent().find("input");

        if (input.attr("type") == "text"){
            // 隐藏密码模式
            // 请求指定账号数据
            var url = baseUrl + "/admin?c=API_PassManager&a=loadPasswd&id=" + passId;
            get(url,function (data) {
                var accData = data.data;
                input.attr("type","password");
                input.val(accData["passwd"]);
                $this.attr("class","iconfont icon-Xtubiao-chakan translation-icon");
            },false);
        }else {
            // 开启查看模式
            var prepass = input.attr("pass");
            // 解密
            var decryptPass = RSADecryptPass(prepass);
            input.attr("type","text");
            input.val(decryptPass);
            $this.attr("class","iconfont icon-Xtubiao-guanbichakan translation-icon");
        }
    }

    // 复制密码
    function copyPass(obj) {
        var $this = $(obj);
        var passId = $this.attr("passId");
        var passInput = $this.parent().find("input");
        var input = $("#real_pass_"+passId);

        // 解密
        var decryptPass = RSADecryptPass(passInput.attr("pass"));
        input.val(decryptPass);
        // 复制密码
        copyInputContent(input,"密码已复制");
    }

    // 确定添加/修改密码
    function confirm() {
        if (passLevel.length == 0){
            toast("请选择安全级别");
            return;
        }
        if (passDesc.length == 0){
            toast("请输入密码描述信息");
            return;
        }
        if (passValue.length == 0){
            toast("请输入密码");
            return;
        }

        // 给密码加密
        passValue = RSAEncryptPass(passValue);
        // base64编码 防止特殊字符提交出错
        passValue = btoa(passValue);

        // 请求添加密码接口
        var url = "";
        if (isEdit){
            // 修改
            url = baseUrl + "/admin?c=API_PassManager&a=editPass"
                + "&id=" + editPassId
                + "&level=" + passLevel
                + "&desc=" + passDesc
                + "&pass=" + passValue;
            console.log("编辑:" + url);
        }else {
            // 添加
            url = baseUrl + "/admin?c=API_PassManager&a=addPass"
                + "&desc=" + passDesc
                + "&pass=" + passValue
                + "&level=" + passLevel;
        }

        console.log("添加密码:" + url);
        get(url,function () {
            // 浮层消失
            hideEditCatCover();
            // 刷新密码列表
            loadPassList();
        },true,true);
    }

    // 取消添加平台
    function cancel() {
        hideEditCatCover();
    }

    // 删除密码
    function deletePass(obj) {
        var $this = $(obj);
        var passId = $this.attr("passId");
        var url = baseUrl + "/admin?c=API_PassManager&a=deletePass&id=" + passId;
        get(url,function () {
            // 刷新列表
            loadPassList();
        },true,true);
    }
    
    // 编辑密码
    function editPass(obj) {
        isEdit = true;
        var $this = $(obj);
        var passId = $this.attr("passId");

        // 请求指定账号数据
        var url = baseUrl + "/admin?c=API_PassManager&a=loadPasswd&id=" + passId;
        get(url,function (data) {
            var accData = data.data;

            editPassId = accData["id"];
            passDesc = accData["pass_desc"];
            passValue = accData["passwd"];
            passLevel = accData["pass_level"];

            // 解密
            passValue = RSADecryptPass(passValue);
            // 显示编辑页面
            showEditCatCover();
        })
    }
    
    // 显示添加/修改平台浮层
    function showEditCatCover() {
        $(".add-category-box").css("display","block");

        layui.use('form', function(){
            var form = layui.form;
            // 安全级别
            $("#pass_level").val(passLevel);

            // 描述
            $("#pass_desc").val(passDesc);

            // 密码
            $("#pass_value").val(passValue);
            form.render();
        });
    }

    // 隐藏添加/修改分类浮层
    function hideEditCatCover() {
        $(".add-category-box").css("display","none");
    }

<?php echo '</script'; ?>
>
<?php
}
}
/* {/block "scriptCode"} */
/* {block "content"} */
class Block_16893136525ee1fe6fe666e7_47957029 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="aw-content-wrap">
    <form id="form" action="?m=admin&c=ServerInfo&a=loadTempleteComplete" method="post" target="exec_target">
    </form>
    <iframe hidden id="exec_target" name="exec_target"></iframe>

    <div class="mod">
        <div class="layui-form" style="text-align: center;">
            <table id="acc_table" class="layui-table">
                <colgroup>
                    <col width="150">
                    <col width="150">
                    <col width="150">
                    <col width="200">
                </colgroup>
                <thead>
                <tr>
                    <th>密码描述</th>
                    <th>密码</th>
                    <th>安全级别</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--添加分类浮层-->
<div class="add-category-box">
    <div class="add-category-container">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
            <legend>添加密码</legend>
        </fieldset>
        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">安全级别</label>
                <div class="layui-input-inline">
                    <select id="pass_level" lay-filter="pass-level">
                        <option value="" >请选择安全级别</option>
                        <option value="1" >低</option>
                        <option value="2" >中</option>
                        <option value="3" >高</option>
                        <option value="4" >最高</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码描述</label>
                <div class="layui-input-inline user-name">
                    <input id="pass_desc" type="text" lay-verify="required" placeholder="请输入密码描述信息" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-inline user-name">
                    <input id="pass_value" type="text" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                </div>
            </div>
        </form>

        <!--确定/取消按钮-->
        <div class="btns-box">
            <button onclick="cancel()" type="button" class="layui-btn layui-btn-primary">取消</button>
            <button onclick="confirm()" type="button" class="layui-btn confirm-btn">确认</button>
        </div>
    </div>
</div>
<?php
}
}
/* {/block "content"} */
}

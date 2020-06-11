<?php
/* Smarty version 3.1.30, created on 2020-06-11 10:08:12
  from "/Users/mrchen/Desktop/www/PhpProjects/AccountManager/admin/view/account/index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ee2028c297129_41197955',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '002c09f46cb31974db92e609bd6d5a7866f9756c' => 
    array (
      0 => '/Users/mrchen/Desktop/www/PhpProjects/AccountManager/admin/view/account/index.html',
      1 => 1591869838,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout.html' => 1,
  ),
),false)) {
function content_5ee2028c297129_41197955 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_614714075ee2028c2934a0_22378073', "myStyles");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5959679035ee2028c294425_26459427', "scriptCode");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6593837475ee2028c296403_92498689', "content");
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:layout.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "myStyles"} */
class Block_614714075ee2028c2934a0_22378073 extends Smarty_Internal_Block
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
        height: 600px;
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
        max-width: 60px;
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
        width: 1px;
        height: 1px;
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
class Block_5959679035ee2028c294425_26459427 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
    // 添加账号选择的platid
    var selectedPlatId = '';
    // 要添加账号的描述信息
    var addDesc = "";
    // 要添加账号的用户名
    var addUserName = '';
    // 要添加账号的密码
    var addPassWd = '';
    // 要添加账号的登录地址
    var addAddress = '';
    // 要添加账号的备注
    var addRemark = '';
    // 是否是编辑
    var isEdit = false;
    // 修改平台id
    var editAccountId = "";

    $(document).ready(function () {
        // 设置边栏服务器信息选中状态
        $("#account_manager").addClass("active");

        // 监听输入描述信息
        var descInput = $("#add_user_desc");
        descInput.bind("input propertychange", function (event) {
            addDesc = descInput.val();
        });
        // 监听输入用户名
        var userNameInput = $("#add_user_name");
        userNameInput.bind("input propertychange", function (event) {
            addUserName = userNameInput.val();
        });
        // 监听输入密码
        var passInput = $("#add_pass");
        passInput.bind("input propertychange", function (event) {
            addPassWd = passInput.val();
        });
        // 监听输入登录地址
        var loginAddressInput = $("#login_address");
        loginAddressInput.bind("input propertychange", function (event) {
            addAddress = loginAddressInput.val();
        });
        // 监听输入登录地址
        var remarkInput = $("#acc_remark");
        remarkInput.bind("input propertychange", function (event) {
            addRemark = remarkInput.val();
        });

        // 监听平台选择
        layui.use('form',function () {
            var form = layui.form;
            form.on('select(plat-list)', function(data){
                // 选择的platid
                var platId = data.value;
                selectedPlatId = platId;
            });
        });

        // 监听密码选择
        layui.use('form',function () {
            var form = layui.form;
            form.on('select(pass-list)', function(data){
                // 选择的密码
                var pass = data.value;
                $("#add_pass").val(pass);
                addPassWd = pass;
            });
        });

        // 请求账号列表
        loadAccountList();
    });

    // 获取账号列表
    function loadAccountList() {
        var url = baseUrl + "/admin?c=API_Account&a=loadAccountList";
        console.log("获取账户列表:" + url);
        get(url,function (data) {
            // 创建分类列表
            createAccountDom(data.data);
        },false);
    }

    // 请求平台列表
    function loadPlatList() {
        var url = baseUrl + "/admin?c=API_Platform&a=loadPlatformList";
        get(url, function (data) {
            layui.use('form', function(){
                var form = layui.form;
                var platData = data.data;
                // 创建要选择的分类列表
                var dom = '<option value="">请选择平台</option>';
                for (var i = 0; i < platData.length; i++){
                    var plat = platData[i];
                    dom += '<option value="'+ plat["id"] +'" >'+ plat["plat_name"] +'</option>';
                }
                $("#plat_select").html(dom);
                $("#plat_select").val(selectedPlatId);
                form.render();
                // 显示添加界面
                showEditCatCover();
            });
        })
    }

    // 请求密码列表 返回机密以后的密码
    function loadPassList(success) {
        var url = baseUrl + "/admin?c=API_PassManager&a=loadPassList";
        console.log("请求密码列表:" + url);
        get(url, function (data) {
            layui.use('form', function(){
                var form = layui.form;
                var passData = data.data;
                // 创建要选择的分类列表
                var dom = '<option value="">请选择密码</option>';
                for (var i = 0; i < passData.length; i++){
                    var pass = passData[i];
                    // 密码解密
                    var passwd = RSADecryptPass(pass["passwd"]);
                    dom += '<option value="'+ passwd +'" >'+ passwd +'</option>';
                }
                $("#pass_select").html(dom);
                form.render();

                if (success){
                    success();
                }
            });
        })
    }

    // 添加平台
    function addData() {
        isEdit = false;
        selectedPlatId = "";
        addDesc = "";
        addUserName = "";
        addPassWd = "";
        addAddress = "";
        addRemark = "";
        // 请求密码列表
        loadPassList(function () {
            // 请求平台列表
            loadPlatList();
        });
    }

    // 创建账号列表
    function createAccountDom(data) {
        var dom = "";
        for(var i = 0; i < data.length; i++){
            var account = data[i];
            dom += '<tr><td>'+ account["acc_desc"] +'</td>';
            dom += '<td>'+ account["user"] +'</td>';
            dom += '<td><input pass="'+ account["passwd"] +'" readonly="readonly" type="password" class="layui-input pass-view-input" value="'+ account["passwd"] +'">';
            dom += '<i  accId="'+ account["id"] +'" onclick="previewPass(this)" class="iconfont icon-Xtubiao-chakan translation-icon"></i><i accId="'+ account["id"] +'" id="copy_btn" onclick="copyPass(this)" class="icon icon-reply translation-icon"></i><input class="real-pass" type="text" id="real_pass_'+ account["id"] +'"></td>';
            dom += '<td>'+ account["address"] +'</td>';
            dom += '<td>'+ account["plat_name"] +'</td>';
            dom += '<td>'+ account["remark"] +'</td>';
            dom += '<td><i title="编辑" onclick="editAccount(this)" accId="'+ account["id"] +'" style="cursor: pointer" class="icon icon-edit"></i>';
            dom += '<i title="复制" onclick="copyAccount(this)" accId="'+ account["id"] +'" style="cursor: pointer" class="icon icon-reply"></i>';
            dom += '<i title="删除" platId="'+ account["plat_id"] +'" accId="'+ account["id"] +'" onclick="deleteAccount(this)" style="cursor: pointer" class="icon icon-trash"></i></td></tr>';
        }

        // 添加分类一行
        $("tbody").html(dom);
    }

    // 查看密码
    function previewPass(obj) {
        var $this = $(obj);
        var accId = $this.attr("accId");
        var input = $this.parent().find("input");

        if (input.attr("type") == "text"){
            // 隐藏密码
            // 请求指定账号数据
            var url = baseUrl + "/admin?c=API_Account&a=loadAccount&id=" + accId;
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
        var accId = $this.attr("accId");
        var passInput = $this.parent().find("input");
        var input = $("#real_pass_"+accId);

        // 解密
        var decryptPass = RSADecryptPass(passInput.attr("pass"));
        input.val(decryptPass);
        // 复制密码
        copyInputContent(input,"密码已复制");
    }

    // 确定添加/修改账号
    function confirm() {
        if (selectedPlatId.length == 0){
            toast("请选择平台");
            return;
        }
        if (addDesc.length == 0){
            toast("请输入账户描述信息");
            return;
        }
        if (addUserName.length == 0){
            toast("请输入用户名");
            return;
        }
        if (addPassWd.length == 0){
            toast("请输入密码");
            return;
        }
        if (addAddress.length == 0){
            toast("请输入登录地址");
            return;
        }

        // 用户名和登录地址要base64编码处理 防止特殊字符出错
        addUserName = btoa(addUserName);
        addAddress = btoa(addAddress);

        // 密码加密
        addPassWd = RSAEncryptPass(addPassWd);
        // base64编码
        addPassWd = btoa(addPassWd);

        // 请求添加账号接口
        var url = "";
        if (isEdit){
            // 修改
            url = baseUrl + "/admin?c=API_Account&a=editAccount"
                + "&id=" + editAccountId
                + "&platId=" + selectedPlatId
                + "&desc=" + addDesc
                + "&user=" + addUserName
                + "&pass=" + addPassWd
                + "&address=" + addAddress
                + "&remark=" + addRemark;
        }else {
            // 添加
            url = baseUrl + "/admin?c=API_Account&a=addAccount"
                + "&platId=" + selectedPlatId
                + "&desc=" + addDesc
                + "&user=" + addUserName
                + "&pass=" + addPassWd
                + "&address=" + addAddress
                + "&remark=" + addRemark;
        }

        console.log("添加账户:" + url);
        get(url,function () {
            // 浮层消失
            hideEditCatCover();
            // 刷新账号列表
            loadAccountList();
        },true,true);
    }

    // 取消添加平台
    function cancel() {
        hideEditCatCover();
    }

    // 删除账号
    function deleteAccount(obj) {
        var $this = $(obj);
        var accId = $this.attr("accId");
        var platId = $this.attr("platId");
        var url = baseUrl + "/admin?c=API_Account&a=deleteAccount&id=" + accId + "&platId=" + platId;
        console.log("删除：" + url);
        get(url,function () {
            // 刷新列表
            loadAccountList();
        },true,true);
    }
    
    // 编辑账号
    function editAccount(obj) {
        isEdit = true;
        var $this = $(obj);
        var accId = $this.attr("accId");
        editAccountId = accId;

        // 加载密码列表
        loadPassList(function () {
            // 请求指定账号数据
            var url = baseUrl + "/admin?c=API_Account&a=loadAccount&id=" + accId;
            get(url,function (data) {
                var accData = data.data;
                selectedPlatId = accData["plat_id"];
                addDesc = accData["acc_desc"];
                addUserName = accData["user"];
                addPassWd = accData["passwd"];
                // 解密
                addPassWd = RSADecryptPass(addPassWd);
                addAddress = accData["address"];
                addRemark = accData["remark"];

                // 加载平台列表
                loadPlatList();
            });
        });
    }

    // 复制一个账号
    function copyAccount(obj) {
        isEdit = false;
        var $this = $(obj);
        var accId = $this.attr("accId");
        editAccountId = accId;

        // 加载密码列表
        loadPassList(function () {
            // 请求指定账号数据
            var url = baseUrl + "/admin?c=API_Account&a=loadAccount&id=" + accId;
            get(url,function (data) {
                var accData = data.data;
                selectedPlatId = accData["plat_id"];
                addDesc = accData["acc_desc"];
                addUserName = accData["user"];
                addPassWd = accData["passwd"];
                // 解密
                addPassWd = RSADecryptPass(addPassWd);
                addAddress = accData["address"];
                addRemark = accData["remark"];

                // 加载平台列表
                loadPlatList();
            });
        });
    }

    // 显示添加/修改平台浮层
    function showEditCatCover() {
        $(".add-category-box").css("display","block");
        // 描述
        $("#add_user_desc").val(addDesc);
        // 用户名
        $("#add_user_name").val(addUserName);
        // 密码
        $("#add_pass").val(addPassWd);
        // 登录地址
        $("#login_address").val(addAddress);
        // 备注
        $("#acc_remark").val(addRemark);
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
class Block_6593837475ee2028c296403_92498689 extends Smarty_Internal_Block
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
                    <col width="150">
                    <col width="150">
                    <col >
                    <col width="150">
                </colgroup>
                <thead>
                <tr>
                    <th>账户描述</th>
                    <th>用户名</th>
                    <th>密码</th>
                    <th>登录地址</th>
                    <th>所属平台</th>
                    <th>备注</th>
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
            <legend>添加账号</legend>
        </fieldset>
        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">所属平台</label>
                <div class="layui-input-inline">
                    <select id="plat_select" lay-filter="plat-list">
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">账户描述</label>
                <div class="layui-input-inline user-name">
                    <input id="add_user_desc" type="text" lay-verify="required" placeholder="请输入账户描述信息" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-inline user-name">
                    <input id="add_user_name" type="text" lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-inline pass-word">
                    <input id="add_pass" type="text" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                </div>
                <label class="layui-form-label">快速选择</label>
                <div class="layui-input-inline">
                    <select id="pass_select" lay-filter="pass-list">
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">登录地址</label>
                <div class="layui-input-inline login-address">
                    <input id="login_address" type="text" lay-verify="required" placeholder="请输入登录地址" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">备注</label>
                    <div class="layui-input-block">
                        <textarea style="resize: none;height: 150px" id="acc_remark" placeholder="请输入备注信息" class="layui-textarea"></textarea>
                    </div>
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
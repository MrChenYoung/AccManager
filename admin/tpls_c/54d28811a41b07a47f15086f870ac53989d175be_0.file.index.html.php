<?php
/* Smarty version 3.1.30, created on 2020-06-10 15:29:04
  from "/Users/mrchen/Desktop/www/PhpProjects/AccountManager/admin/view/category/index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ee0fc4078a291_36297759',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '54d28811a41b07a47f15086f870ac53989d175be' => 
    array (
      0 => '/Users/mrchen/Desktop/www/PhpProjects/AccountManager/admin/view/category/index.html',
      1 => 1591802943,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout.html' => 1,
  ),
),false)) {
function content_5ee0fc4078a291_36297759 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20557524495ee0fc40787be8_35784197', "myStyles");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10976076545ee0fc40789059_17194559', "scriptCode");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17269142875ee0fc40789ca3_72431629', "content");
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:layout.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "myStyles"} */
class Block_20557524495ee0fc40787be8_35784197 extends Smarty_Internal_Block
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
        height: 400px;
        background-color: #FFF;
        margin: 150px auto;
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
        color: #bfbfbf;
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

    .plat_list_ul {
        width: 800px;
        height: 30px;
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    .plat_list_ul li {
        font-size: 12px;
        height: 20px;
        float: left;
        margin-right: 10px;
        padding: 5px;
        background-color: #e6e6e6;
    }

</style>
<?php
}
}
/* {/block "myStyles"} */
/* {block "scriptCode"} */
class Block_10976076545ee0fc40789059_17194559 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
    // 添加分类选择的icon
    var selectedIcon = '';
    // 添加分类的分类名
    var addCatName = '';
    // 是否是修改分类
    var isEdit = false;
    // 修改分类的id
    var editCatId = "";

    $(document).ready(function () {
        // 设置边栏服务器信息选中状态
        $("#category_manager").addClass("active");

        // 监听添加分类输入分类名
        var addCatInput = $("#add_cat_name");
        addCatInput.bind("input propertychange", function (event) {
            addCatName = addCatInput.val();
        });

        // 请求分类列表
        loadCategoryList();
        // 请求icon
        loadIcons();
    });

    // 获取分类列表
    function loadCategoryList() {
        var url = baseUrl + "/admin?c=API_Category&a=loadCategotyList";
        console.log("分类:" + url);
        get(url,function (data) {
            // 创建分类列表
            createCategoryDom(data.data);
        },false);
    }

    // 请求icon
    function loadIcons() {
        var url = baseUrl + "/admin/?c=API_Icon&a=getAliIconfonts&API=";
        get(url, function (data) {
            layui.use('form', function(){
                var form = layui.form;
                var icons = data.data;
                // 创建要选择的icon
                var dom = "";
                for (var i = 0; i < icons.length; i++){
                    var icon = icons[i];
                    dom += '<li><i icon="'+ icon +'" onclick="confirmIcon(this)" class="iconfont icon-'+ icon +'"></i></li>';
                }
                $(".icons-box ul").html(dom);
                form.render();
            });
        })
    }

    // 添加分类
    function addData() {
        isEdit = false;
        selectedIcon = "";
        addCatName = "";
        showEditCatCover();
    }

    // 创建分类列表
    function createCategoryDom(data) {
        var dom = "";
        for(var i = 0; i < data.length; i++){
            var category = data[i];
            dom += '<tr><td><i class="iconfont icon-'+ category["cat_icon"] +'"></i></td>';
            dom += '<td>' + category["cat_title"] + '</td>';
            dom += '<td><ul class="plat_list_ul">';

            var platList = category["platform_list"];
            for (var j = 0; j < platList.length; j++){
                var plat = platList[j];
                dom += '<li>'+ plat +'</li>';
            }
            dom += '</ul></td>';
            dom += '<td><i onclick="editCategory(this)" catId="'+ category["id"] +'" style="cursor: pointer" class="icon icon-edit"></i>';
            dom += '<i catId="'+ category["id"] +'" onclick="deleteCat(this)" style="cursor: pointer" class="icon icon-trash"></i></td>';
        }

        // 添加分类一行
        $("tbody").html(dom);
    }

    // 确定选择的icon
    function confirmIcon(obj) {
        var $this = $(obj);
        var iconName = $this.attr("icon");
        selectIcon(iconName);
    }

    // 选择图标
    function selectIcon(iconName) {
        if (iconName.length > 0){
            var btnContent = '已选择 <i class="iconfont icon-'+ iconName +'"></i>';
            $(".layui-input-inline button").html(btnContent);
            $(".layui-input-inline button i").css("color","#393D49");
            selectedIcon = iconName;
        }else {
            $(".layui-input-inline button").html("请选择");
        }
    }
    
    // 确定添加分类
    function confirm() {
        if (selectedIcon.length == 0){
            toast("请选择图标");
            return;
        }
        if (addCatName.length == 0){
            toast("请输入分类名");
            return;
        }

        // 请求添加分类接口
        var url = "";
        if (isEdit){
            // 修改
            url = baseUrl + "/admin?c=API_Category&a=editCategory&icon=" + selectedIcon + "&catName=" + addCatName + "&id=" + editCatId;
        }else {
            // 添加
            url = baseUrl + "/admin?c=API_Category&a=addCategory&icon=" + selectedIcon + "&catName=" + addCatName;
        }

        get(url,function () {
            // 浮层消失
            hideEditCatCover();
            // 刷新分类列表
            loadCategoryList();
        },true,true);
    }

    // 取消添加分类
    function cancel() {
        hideEditCatCover();
    }

    // 删除分类
    function deleteCat(obj) {
        var $this = $(obj);
        var catId = $this.attr("catId");
        var url = baseUrl + "/admin?c=API_Category&a=deleteCategory&id=" + catId;
        get(url,function () {
            // 刷新列表
            loadCategoryList();
        },true,true);
    }
    
    // 编辑分类
    function editCategory(obj) {
        isEdit = true;
        var $this = $(obj);
        var catId = $this.attr("catId");
        editCatId = catId;

        // 请求指定分类数据
        var url = baseUrl + "/admin?c=API_Category&a=loadCategory&id=" + catId;
        get(url,function (data) {
            var catData = data.data;
            selectedIcon = catData["cat_icon"];
            addCatName = catData["cat_title"];
            showEditCatCover();
        })
    }
    
    // 显示添加/修改分类浮层
    function showEditCatCover() {
        $(".add-category-box").css("display","block");
        selectIcon(selectedIcon);

        $("#add_cat_name").val(addCatName);
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
class Block_17269142875ee0fc40789ca3_72431629 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="aw-content-wrap">
    <form id="form" action="?m=admin&c=ServerInfo&a=loadTempleteComplete" method="post" target="exec_target">
    </form>
    <iframe hidden id="exec_target" name="exec_target"></iframe>

    <div class="mod">
        <div class="layui-form" style="text-align: center;">
            <table class="layui-table">
                <colgroup>
                    <col width="150">
                    <col width="150">
                    <col>
                    <col width="200">
                </colgroup>
                <thead>
                <tr>
                    <th>分类图标</th>
                    <th>分类名</th>
                    <th>平台</th>
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
            <legend>添加分类</legend>
        </fieldset>
        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">图标</label>
                <div class="layui-input-inline">
                    <button disabled="disabled" type="button" class="layui-btn layui-btn-primary">请选择</button>
                </div>
            </div>
            <div class="icons-box">
                <ul>
                </ul>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">分类名称</label>
                <div class="layui-input-inline cat-name">
                    <input id="add_cat_name" type="text" name="username" lay-verify="required" placeholder="请输入分类名称" autocomplete="off" class="layui-input">
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

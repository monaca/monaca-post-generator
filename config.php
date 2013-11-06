<?php
$categories = '';
foreach ($_POST['categories'] as $key=>$value) {
  $categories .= $key.': "'. $value .'",';
}
$categories = trim($categories, ',');
?>
// WordPress側で生成する設定情報
var app_config = {
  blog_id:<?php print $_POST['blog_id']; ?>,
  username:'<?php print $_POST['username'] ?>',
  password:'<?php print $_POST['password'] ?>',
  xmlrpc_endpoint:'<?php print $_POST['xmlrpc_endpoint'] ?>',
  author:<?php print $_POST['author'] ?>,
  post_status:'<?php print $_POST['post_status'] ?>',
  local_config:<?php print $_POST['local_config'] ?>,
  thumbnail:{
    targetWidth:<?php print $_POST['thumbnail']['targetWidth'] ?>,
    targetHeight:<?php print $_POST['thumbnail']['targetHeight'] ?> 
  },
  category:{
    <?php print $categories ?>
  }
};


function saveConfig() {
  var local_config = {
    username:$('#username').val(),
    password:$('#password').val()
  };
  localStorage.setItem("local_config", JSON.stringify(local_config));
}

function loadConfig(){
  var local_config = JSON.parse(localStorage.getItem('local_config'));
  for (var key in local_config){
    app_config[key] = local_config[key];
  }
}

$(document).ready(function(){
  if (app_config.local_config) {
    loadConfig();
  }
  $('#username').val(app_config.username);
  $('#password').val(app_config.password);
  
  $("#save_config").on('submit',function(){
    saveConfig();
    location.reload();
    return false;
  });
  
  // カテゴリ生成
  putCategory();
});
function putCategory(){
　for (var key in app_config.category){
  $("#wp_post [name=category]")
  .append('<input type="checkbox" name="category[]" value="'+ key +'" id="t'+ key +'"><label for="t'+ key +'">'+ app_config.category[key] +'</label>');
  }
}

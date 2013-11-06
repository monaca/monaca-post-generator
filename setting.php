<h2>MonacaPostの設定</h2>
<p>特に必要が無い場合は変更を行わずに「設定を反映する」ボタンを押してください。
設定内容は投稿アプリ内の「js/config.js」ファイルに記載されます。
この設定は後でMonaca側で設定変更することが可能です。
</p>
<?php
if (!get_option('enable_xmlrpc')):
?><p>このサイトではxmlrpc機能が無効化されているためMonacaPostは動作しません。</p><?php
endif;
?>
<ul>

<form action="" method="post" autocomplete="off">
<table class="form-table">
  <tr>
    <th>項目名</th>
    <th>項目値</th>
    <th>説明</th>
  </tr>
  <tr>
    <th>blog_id</th>
    <td>
      <input type="text" name="blog_id" value="<?php print esc_attr($setting['blog_id']); ?>">
    </td>
    <td>
      <p>blog_idは通常「1」を設定してください。もし複数ブログを展開している場合には更新したいブログの番号を指定します。</p>
    </td>
  </tr>
  <tr>
    <th>username (任意)</th>
    <td>
      <input type="text" name="username" value="<?php print esc_attr($setting['username']); ?>">
    </td>
    <td>
      <p>投稿アプリからWordPressにログインするためのユーザー名を事前に設定できます。</p>
    </td>
  </tr>
  <tr>
    <th>password (任意)</th>
    <td>
      <input type="password" name="password" value="<?php print esc_attr($setting['password']); ?>">
    </td>
    <td>
      <p>投稿アプリからWordPressにログインするためのパスワードを事前に設定できます。</p>
    </td>
  </tr>
  <tr>
    <th>xmlrpc_endpoint</th>
    <td>
      <input type="text" name="xmlrpc_endpoint" value="<?php print esc_attr($setting['xmlrpc_endpoint']); ?>" size=60>
    </td>
    <td>
      <p>投稿アプリからWordPressを操作するために必要なURLです。通常は変更不要です。</p>
    </td>
  </tr>
  <tr>
    <th>author</th>
    <td>
      <input type="text" name="author" value="<?php print esc_attr($setting['author']); ?>">
    </td>
    <td>
      <p>投稿者IDは通常1を設定してください。もし複数人でブログを更新している場合には任意の投稿者IDを設定します。</p>
    </td>
  </tr>
  <tr>
    <th>post_status</th>
    <td>
      <?php 
        $post_status_list = get_post_statuses();
        krsort($post_status_list);
        foreach($post_status_list as $key => $val) :
        ?><input type="radio" name="post_status" 
        value="<?php print esc_attr($key); ?>"
        <?php if ($setting['post_status'] == $key) : ?>checked="checked"<?php endif;?>
        ><label><?php print esc_attr($val); ?></label><?php
        endforeach;
      ?>
    </td>
  </tr>
  <tr>
    <th>local_config</th>
    <td>
      <input type="radio" name="local_config" value="1" 
        <?php if($setting['local_config']): ?>checked="checked"<?php endif;?>>有効
      <input type="radio" name="local_config" value="0" 
        <?php if(!$setting['local_config']): ?>checked="checked"<?php endif;?>>無効
    </td>
  </tr>
  <tr>
    <th>thumbnail</th>
    <td>
      高さ<input type="text" name="thumbnail[targetWidth]" size="6" value="<?php print esc_attr($setting['thumbnail']['targetWidth']); ?>">px<br>
      横幅<input type="text" name="thumbnail[targetHeight]" size="6" value="<?php print esc_attr($setting['thumbnail']['targetHeight']); ?>">px
    </td>
  </tr>
  <tr>
    <th>category</th>
    <td>
      <?php 
        $categories = get_categories('get=all');
        foreach($categories as $val) :
        ?><input type="checkbox" name="categories[<?php print esc_attr($val->term_id); ?>]" 
        value="<?php print esc_attr($val->name); ?>"
        <?php if (true) : ?>checked="checked"<?php endif;?>
        ><label><?php print esc_attr($val->name); ?></label><?php
        endforeach;
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <input class="button-primary" type="submit" name="submit" value="設定を反映する">
    </td>
  </tr>
</table>
</form>

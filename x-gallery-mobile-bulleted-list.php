<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

widget_css();

if( $widget_config['forum1'] ) $_bo_table = $widget_config['forum1'];
else $_bo_table = $widget_config['default_forum_id'];

if ( empty($_bo_table) ) jsAlert('Error: empty $_bo_table ? on widget :' . $widget_config['name']);

if( $widget_config['no'] ) $limit = $widget_config['no'];
else $limit = 7;

$list = g::posts( array(
			"bo_table" 	=>	$_bo_table,
			"limit"		=>	$limit,
			"select"	=>	"idx,domain,bo_table,wr_id,wr_parent,wr_is_comment,wr_comment,ca_name,wr_datetime,wr_hit,wr_good,wr_nogood,wr_name,mb_id,wr_subject,wr_content"
				)
		);
		
$title_query = "SELECT bo_subject FROM ".$g5['board_table']." WHERE bo_table = '".$_bo_table."'";
$title = cut_str(db::result( $title_query ),20,"...");

?>


<div class="gallery_bulleted_list">
    <div class="bulleted_list_title">		
		<?=$title?>
	</div>
    <ul>
    <?php for ($i=0; $i<count($list); $i++) {?>
        <li>
			<img src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/bullet.png'/>			
			<div class='content'><a href='<?=$list[$i]['href']?>'><?=cut_str(get_text(strip_tags($list[$i]['wr_subject'])),40,"...")?></a></div>            
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
		<? for ( $i=0; $i < 7; $i++ ) {?>
			 <li>
				<img src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/bullet.png'/>
				<div class='content'><a href='<?=G5_BBS_URL?>/write.php?bo_table=<?=$bo_table?>'>글을 등록해 주세요</a></div>            
			</li>
		<? }?>
    <?php }  ?>
    </ul>    
</div>
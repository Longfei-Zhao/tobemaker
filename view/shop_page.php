<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>tobeMaker-shop</title>
    <?php include "top_css.php" ?>
</head>
<body>
<div id="top">
    <?php include "header.php" ?>
</div>
<div id="center">
    <div class="middle">
        <div class="shop">
            <div class="menu">
                <ul>
				<?php 
				
				for($i=0;$i<count($categoryList);$i++)
                      {
					  if($categoryList[$i]["pc_id"]!=$category)
					  echo '<li><div><a href="shop.php?categoryID='.$categoryList[$i]["pc_id"].'">'.$categoryList[$i]["pc_name"].'</a></div></li>';
					  else
					  {
					   echo '<li class="active"><div ><a href="shop.php?categoryID='.$categoryList[$i]["pc_id"].'">'.$categoryList[$i]["pc_name"].'</a></div></li>';
                       }
					  }				
			    ?>
                    
                </ul>
            </div>
            <div class="goods">
                <div class="left">
				<?php
				//循环输出左列商品
				
                for($i=($curPage-1)*$perPageCount;$i<count($productList)&&$i<($curPage)*$perPageCount;$i+=2)
                {
				$strProduct='<div><a href="'.$productList[$i]["pf_link"].'"><img src="';
				$strProduct=$strProduct.$productList[$i]["pf_image"].'" alt="">';
				if(empty($productList[$i]["pf_label"]))
				{
				$strProduct=$strProduct.'<span>'.$productList[$i]["pf_discount"];
				}
				else
				{
				$strProduct=$strProduct.'<label>'.$productList[$i]["pf_label"].'</label><span>'.$productList[$i]["pf_discount"];
				}
				if(empty($productList[$i]["pf_price"])||$productList[$i]["pf_price"]=='0.00')
				{
				$strProduct=$strProduct.'</span></a></div>';
				}
				else
				{
				$strProduct=$strProduct.'<b>'.$productList[$i]["pf_price"].'</b></span></a></div>';
				}
				echo $strProduct;
				}				
				?>
                    
                   
                </div>
                <div class="right">
				<?php
				//循环输出右列商品
				
                for($i=($curPage-1)*$perPageCount+1;$i<count($productList)&&$i<($curPage)*$perPageCount;$i+=2)
                {
				$strProduct='<div><a href="'.$productList[$i]["pf_link"].'"><img src="';
				$strProduct=$strProduct.$productList[$i]["pf_image"].'" alt="">';
				if(empty($productList[$i]["pf_label"]))
				{
				$strProduct=$strProduct.'<span>'.$productList[$i]["pf_discount"];
				}
				else
				{
				$strProduct=$strProduct.'<label>'.$productList[$i]["pf_label"].'</label><span>'.$productList[$i]["pf_discount"];
				}
				if(empty($productList[$i]["pf_price"]))
				{
				$strProduct=$strProduct.'</span></a></div>';
				}
				else
				{
				$strProduct=$strProduct.'<b>'.$productList[$i]["pf_price"].'</b></span></a></div>';
				}
				echo $strProduct;
				}				
				?>
                    
                </div>
                <br class="clear"/>

                <div class="pagenum">
				<?php
				//输出页码
				
				$pageCount=(count($productList)/$perPageCount)+((count($productList)%$perPageCount==0)?0:1);
				
				for($i=1;$i<=$pageCount&&$pageCount>2;$i++)
				{
				if($curPage!=$i)
				 echo '<a href="shop.php?categoryID='.$category.'&curPage='.$i.'">'.$i.'</a>';
				 else
				 {
				  echo '<a class="active" href="shop.php?categoryID='.$category.'&curPage='.$i.'">'.$i.'</a>';
				 }
				}
				?>
                    

                </div>


            </div>

            <br class="clear"/>

        </div>

    </div>

</div>
<div id="footer">
    <?php include "footer.php" ?>
</div>

<?php include "bottom_js.php" ?>
    
<script>
    $(function(){
        $(".menu li").click(function(){
            $(this).siblings().removeClass("active").end().addClass("active");
        })
    })
</script>
</body>
</html>
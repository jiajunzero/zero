/*
@功能：购物车页面js
@作者：diamondwang
@时间：2013年11月14日
*/

$(function(){
	
	//减少
	$(".reduce_num").click(function(){
        var _self=this;

        var _goodsId=$(this).parent().attr('goodsId');
        var _attrIds=$(this).parent().attr('attrIds');
        var _flag='-';
        $.ajax({
            type: 'get',
            url: updUrl,
            dataType: 'text',
            data: {'goodsId': _goodsId, 'attrIds': _attrIds,'flag':_flag},
            success: function (json) {
				if(json=='ok'){
                    var amount = $(_self).parent().find(".amount");
                    if (parseInt($(amount).val()) <= 1){
                        alert("商品数量最少为1");
                    } else{
                        $(amount).val(parseInt($(amount).val()) - 1);
                    }
                    //小计
                    var subtotal = parseFloat($(_self).parent().parent().find(".col3 span").text()) * parseInt($(amount).val());
                    $(_self).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
                    //总计金额
                    var total = 0;
                    $(".col5 span").each(function(){
                        total += parseFloat($(_self).text());
                    });

                    $("#total").text(total.toFixed(2));
				}else{
					alert('系统繁忙');
					return false;
				}


            }


        })


	});

	//增加
	$(".add_num").click(function(){

		var _self=this;

		var _goodsId=$(this).parent().attr('goodsId');
		var _attrIds=$(this).parent().attr('attrIds');
		var _flag='+';
		$.ajax({
			type:'get',
			url:updUrl,
			dataType:'text',
			data:{'goodsId':_goodsId,'attrIds':_attrIds,'flag':_flag},
			success:function(json){
				if(json=='ok'){
                    var amount = $(_self).parent().find(".amount");
                    $(amount).val(parseInt($(amount).val()) + 1);
                    //小计
                    var subtotal = parseFloat($(_self).parent().parent().find(".col3 span").text()) * parseInt($(amount).val());
                    $(_self).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
                    //总计金额
                    var total = 0;
                    $(".col5 span").each(function(){
                        total +=parseFloat($(_self).text());
                    });

                    $("#total").text(total.toFixed(2));
				}else{
					alert ('系统繁忙');
					return false;
				}
		   }
		})



	});

	//直接输入
	$(".amount").blur(function(){
		if (parseInt($(this).val()) < 1){
			alert("商品数量最少为1");
			$(this).val(1);
		}
		//小计
		var subtotal = parseFloat($(this).parent().parent().find(".col3 span").text()) * parseInt($(this).val());
		$(this).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
		//总计金额
		var total = 0;
		$(".col5 span").each(function(){
			total += parseFloat($(this).text());
		});

		$("#total").text(total.toFixed(2));

	});
});
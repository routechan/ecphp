$(document).ready(function(){
    $('.send').click(function(event){
        event.preventDefault(); // デフォルトのフォーム送信を防ぐ

        let $form = $(this).closest('form');
        let $product_id = $form.find('.product_id').val();
        let $user_id = $form.find('.user_id').val();
        let request_url = 'into_cart.php';

        let data = {
            product_id : $product_id,
            user_id : $user_id
        };

        setTimeout(function() {
            let data = {
                product_id : $product_id,
                user_id : $user_id
            };

            $.ajax({
                url: request_url,
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        alert('カートに商品が追加されました！');
                        // 必要であれば、ページをリロードしたり、UIを更新
                    } else {
                        alert('カートに商品を追加できませんでした。');
                    }
                },
                error: function() {
                    alert('エラーが発生しました。再度お試しください。');
                }
            });
        }, 5000); // 5000ミリ秒 = 5秒
    });
});

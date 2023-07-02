@extends('layouts.app')
@section('content')
    
<h2>商品列表</h2>
<table class="table">
    <thead>
        <tr>
            <td>名稱</td>
            <td>內容</td>
            <td>價格</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ $product->content }}</td>
                <td style="{{ $product->price < 20 ? 'color:red; font-size:22px' : '' }}">{{ $product->price }}
                </td>
                <td>
                    <input class='check_product' type='button' value='確認商品數量' data-id="{{ $product->id }}">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $('.check_product').on('click', function() {
        $.ajax({
                method: 'POST',
                url: '/products/check-product',
                data: {
                    id: $(this).data('id')
                }
            })
            .done(function(res) {
                if (res) {
                    alert('數量充足');
                } else {
                    alert('數量不足');
                }
            })
    })
</script>

@endsection
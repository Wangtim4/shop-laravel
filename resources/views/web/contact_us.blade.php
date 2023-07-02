@extends('layouts.app')
@section('content')
<h2>聯絡我們</h2>

<form action="">
    <label for="">姓名: </label>
    <input type="text"><br>
    <label for="">填寫時間: </label>
    <input type="date"><br>
    <label for="">購買商品: </label>
    <select name="" id="">
        <option value="物品">物品</option>
        <option value="食物">食物</option>
    </select><br>
    <button>送出</button>
</form>
    
@endsection

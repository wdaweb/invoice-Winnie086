<form action="api/add_invoice.php" method="post">

<div class="container justify-content-center">

  <div>日期:<input type="date" name="date"></div>
  期別:<select name="period">
        <option value="1">第一期：1-2月</option>
        <option value="2">第二期：3-4月</option>
        <option value="3">第三期：5-6月</option>
        <option value="4">第四期：7-8月</option>
        <option value="5">第五期：9-10月</option>
        <option value="6">第六期：11-12月</option>
    </select>
    
    <div>發票號碼:
        <input type="text" name="code" style="width:160px"  placeholder="二個大寫英字母"  maxlength="2" onkeyup="value=value.replace(/[^A-Z]/g,'')" required> -
        <input type="number" name="number" style="width:200px" placeholder="八個數字" onkeyup="value=this.value.replace(/[^/0-9] /g,'')" required>
    </div> 

    <div>發票金額:
        <input type="number" name="payment" placeholder="請輸入阿拉伯數字" oninput="value=value.replace(/[^\d]/g,'')">
    </div>

    <br>

    <div class="text-center">
        <input type="submit" value="送出" class="btn btn-dark">
    </div>

  </form>

  </div>


  






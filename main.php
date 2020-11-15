<form action="api/add_invoice.php" method="post">
  <div>日期:<input type="date" name="date"></div>
  期別:<select name="period">
        <option value="1">一二月</option>
        <option value="2">三四月</option>
        <option value="3">五六月</option>
        <option value="4">七八月</option>
        <option value="5">九十月</option>
        <option value="6">十一、十二月</option>
    </select>
    
    <div>發票號碼:
        <input type="text" name="code" style="width:50px">
        <input type="number" name="number" style="width:150px">
    </div>

    <div>發票金額
        <input type="number" name="payment">
    </div>

    <div class="text-center">
        <input type="submit" value="送出">
    </div>

  </form>



  






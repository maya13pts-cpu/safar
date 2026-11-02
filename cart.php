<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلة الحجوزات</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:hover {
            background-color: #f1f2f6;
        }
        .btn-delete {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-delete:hover {
            background-color: #c0392b;
        }
        .cart-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid #eee;
        }
        .checkout-btn {
            background-color: #2ecc71;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }
        .checkout-btn:hover {
            background-color: #27ae60;
        }
        .empty-cart {
            text-align: center;
            font-size: 18px;
            color: #7f8c8d;
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>سلة الحجوزات</h2>

        <!-- جدول الحجوزات -->
        <table id="cartTable">
            <thead>
                <tr>
                    <th>اسم الرحلة / الفعالية</th>
                    <th>السعر</th>
                    <th>العدد</th>
                    <th>الإجمالي الفرعي</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody id="cartItems">
                <!-- عناصر تجريبية ستظهر بالـ JavaScript -->
                <tr>
                    <td>رحلة استكشافية إلى الصحراء</td>
                    <td>150 ر.س</td>
                    <td>2</td>
                    <td>300 ر.س</td>
                    <td><button class="btn-delete" onclick="removeItem(this)">حذف</button></td>
                </tr>
                <tr>
                    <td>فعالية الألعاب النارية</td>
                    <td>100 ر.س</td>
                    <td>1</td>
                    <td>100 ر.س</td>
                    <td><button class="btn-delete" onclick="removeItem(this)">حذف</button></td>
                </tr>
            </tbody>
        </table>

        <!-- رسالة السلة الفارغة -->
        <div id="emptyMessage" class="empty-cart" style="display: none;">
            <p>السلة فارغة حالياً. لم تقومي بإضافة أي رحلات أو فعاليات بعد.</p>
        </div>

        <!-- ملخص السلة -->
        <div class="cart-summary" id="cartSummary">
            <h3>إجمالي المبلغ: <span id="totalAmount" style="color: #27ae60;">400 ر.س</span></h3>
            <a href="#" class="checkout-btn" onclick="alert('تم الانتقال لصفحة الدفع بنجاح!'); return false;">الإنتقال لإتمام الحجز والدفع</a>
        </div>
    </div>

    <!-- كود JavaScript للتحكم بالتفاعل (حذف العناصر وتحديث الإجمالي) -->
    <script>
        function removeItem(button) {
            // حذف الصف الخاص بالمنتج
            const row = button.closest('tr');
            row.remove();

            // تحديث الإجمالي أو إظهار رسالة السلة الفارغة
            updateTotal();
        }

        function updateTotal() {
            const tbody = document.getElementById('cartItems');
            const rows = tbody.getElementsByTagName('tr');
            let total = 0;

            for (let i = 0; i < rows.length; i++) {
                const priceText = rows[i].cells[1].innerText;
                const qtyText = rows[i].cells[2].innerText;
                
                const price = parseFloat(priceText);
                const qty = parseInt(qtyText);
                
                total += price * qty;
            }

            document.getElementById('totalAmount').innerText = total + ' ر.س';

            // إذا أصبحت السلة فارغة
            if (rows.length === 0) {
                document.getElementById('cartTable').style.display = 'none';
                document.getElementById('cartSummary').style.display = 'none';
                document.getElementById('emptyMessage').style.display = 'block';
            }
        }
    </script>

</body>
</html>

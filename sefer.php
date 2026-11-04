<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الرحلات والخدمات - سَفَر</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-beige: #f7f4ef;          
            --primary-accent: #a3704c;    
            --dark-brown: #3C2A21;        
            --btn-beige: #a58f70;
            --accent-gold: #C5A059;
        }

        body {
            font-family: 'Cairo', sans-serif;
            margin: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.8)), url('tt.jpeg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            min-height: 100vh;
        }

        header {
            background-color: rgba(242, 233, 220, 0.95);
            backdrop-filter: blur(8px);
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e6d7c3;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 800;
            color: var(--dark-brown);
        }

        header nav a {
            color: var(--dark-brown);
            text-decoration: none;
            margin-left: 20px;
            font-weight: 700;
            font-size: 15px;
            padding: 8px 16px;
            border-radius: 20px;
            transition: all 0.3s;
        }

        header nav a.btn-nav-auth {
            background-color: var(--btn-beige);
            color: #fff;
        }

        header nav a:hover {
            opacity: 0.8;
        }

        .container {
            max-width: 850px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            color: #fff;
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        .subtitle {
            text-align: center;
            color: #e0d6c8;
            margin-bottom: 35px;
            font-size: 16px;
            font-weight: 600;
        }

        .tour-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 28px;
            margin-bottom: 25px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            border-right: 6px solid var(--accent-gold);
            color: var(--dark-brown);
        }

        .tour-title {
            color: var(--dark-brown);
            font-size: 22px;
            font-weight: 800;
            margin-top: 0;
            margin-bottom: 6px;
        }

        .location {
            font-size: 14px;
            color: var(--primary-accent);
            margin-bottom: 12px;
            font-weight: 700;
        }

        .desc {
            font-size: 14px;
            color: #555;
            line-height: 1.7;
            margin-bottom: 18px;
        }

        .meta-box {
            background: #faf6f0;
            padding: 12px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 13px;
            color: var(--dark-brown);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            font-weight: 600;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eee;
            padding-top: 16px;
        }

        .price-tag {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary-accent);
        }

        .actions-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-experience {
            background-color: #FAF8F5;
            color: var(--dark-brown);
            border: 1px solid var(--accent-gold);
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Cairo', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-experience:hover {
            background-color: var(--accent-gold);
            color: #fff;
        }

        .btn-book {
            background-color: var(--accent-gold);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 15px;
        }

        .btn-book:hover {
            background-color: #A6823C;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(60, 42, 33, 0.85);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 650px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            border: 1px solid rgba(197, 160, 89, 0.4);
            position: relative;
            color: var(--dark-brown);
        }

        .close-btn {
            position: absolute;
            top: 15px;
            left: 20px;
            font-size: 28px;
            font-weight: bold;
            color: var(--dark-brown);
            cursor: pointer;
            transition: 0.3s;
        }

        .close-btn:hover {
            color: var(--accent-gold);
        }

        .video-container {
            position: relative;
            width: 100%;
            margin-top: 15px;
            margin-bottom: 20px;
            border-radius: 12px;
            overflow: hidden;
            background: #000;
        }

        .video-container video {
            width: 100%;
            max-height: 380px;
            border-radius: 12px;
            display: block;
        }

        .btn-gold-modal {
            display: inline-block;
            background-color: var(--accent-gold);
            color: #fff;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            transition: 0.3s;
        }

        .btn-gold-modal:hover {
            background-color: #A6823C;
        }
    </style>
</head>
<body>

    <header>
        <div class="logo-area">
            <img src="1000048940.jpg" alt="شعار سَفَر" class="logo-img" onerror="this.style.display='none';">
            <div class="logo-text">سَفَر | SAFAR</div>
        </div>
        <nav>
            <a href="sefer.php">الرئيسية</a>
            <a href="services.php">الرحلات والخدمات</a>
            <a href="cart.php">سلة الحجوزات</a>
            <a href="login.php" class="btn-nav-auth">تسجيل الدخول</a>
        </nav>
    </header>

    <div class="container">
        <h1>استكشف وجهات وتجارب سَفَر</h1>
        <div class="subtitle">اختر جولتك السياحية التراثية المفضلة واستعرض التفاصيل الدقيقة لكل رحلة</div>

        <!-- رحلة 1 -->
        <div class="tour-card">
            <div class="tour-title">جولة هايكنج في جبال السودة</div>
            <div class="location">📍 الموقع: منطقة عسير - جبال السودة، أبها</div>
            <div class="desc">استكشاف المسارات الجبلية الوعرة وأجواء الضباب الساحرة في أبها برفقة مرشد محلي خبير.</div>
            
            <div class="meta-box">
                <div>🧭 <strong>المرشد:</strong> فهد القحطاني (مرشد مرتفعات وطبيعة)</div>
                <div>⏰ <strong>المدة:</strong> 4 ساعات</div>
            </div>
            
            <div class="card-footer">
                <div class="price-tag">150 ر.س</div>
                <div class="actions-group">
                    <button class="btn-experience" onclick="openVideoModal('alsoudah.mp4', 'جولة هايكنج في جبال السودة', 1)">
                        <i class="fa-solid fa-play"></i> عيش التجربة
                    </button>
                    <button class="btn-book" onclick="addToCart('جولة هايكنج في جبال السودة', 150)">حجز التجربة</button>
                </div>
            </div>
        </div>

        <!-- رحلة 2 -->
        <div class="tour-card">
            <div class="tour-title">ورشة صناعة فخار في العلا</div>
            <div class="location">📍 الموقع: منطقة الحجر التاريخية - محافظة العلا</div>
            <div class="desc">عش أصالة التراث العريق وتعرف على حرف الأجداد الطينية وسط الطبيعة التاريخية الخلابة.</div>
            
            <div class="meta-box">
                <div>🧭 <strong>المرشد:</strong> نورة العتيبي (أخصائية حرف تراثية)</div>
                <div>⏰ <strong>المدة:</strong> 3 ساعات</div>
            </div>
            
            <div class="card-footer">
                <div class="price-tag">100 ر.س</div>
                <div class="actions-group">
                    <button class="btn-experience" onclick="openVideoModal('pottery.mp4', 'ورشة صناعة فخار في العلا', 2)">
                        <i class="fa-solid fa-play"></i> عيش التجربة
                    </button>
                    <button class="btn-book" onclick="addToCart('ورشة صناعة فخار في العلا', 100)">حجز التجربة</button>
                </div>
            </div>
        </div>

        <!-- رحلة 3 -->
        <div class="tour-card">
            <div class="tour-title">تجربة غزل الصوف التقليدي</div>
            <div class="location">📍 الموقع: القرية التراثية - الطائف</div>
            <div class="desc">تعلم حياكة صوف الغنم وصنع خيوط وملابس تقليدية يدوياً على أصول الأجداد.</div>
            
            <div class="meta-box">
                <div>🧭 <strong>المرشد:</strong> نورة العتيبي (أخصائية حرف تراثية)</div>
                <div>⏰ <strong>المدة:</strong> ساعتان ونصف</div>
            </div>
            
            <div class="card-footer">
                <div class="price-tag">70 ر.س</div>
                <div class="actions-group">
                    <button class="btn-experience" onclick="openVideoModal('wool.mp4', 'تجربة غزل الصوف التقليدي', 3)">
                        <i class="fa-solid fa-play"></i> عيش التجربة
                    </button>
                    <button class="btn-book" onclick="addToCart('تجربة غزل الصوف التقليدي', 70)">حجز التجربة</button>
                </div>
            </div>
        </div>

        <!-- رحلة 4 -->
        <div class="tour-card">
            <div class="tour-title">رحلة سفاري وكثبان الصحراء</div>
            <div class="location">📍 الموقع: الصحراء الشرقية - رمال الربع الخالي</div>
            <div class="desc">مغامرة استكشاف الكثبان الرملية الذهبية، ركوب الإبل، وجلسة سمر تقليدية تحت النجوم.</div>
            
            <div class="meta-box">
                <div>🧭 <strong>المرشد:</strong> سالم المري (دليل الصحراء والبدو)</div>
                <div>⏰ <strong>المدة:</strong> 6 ساعات</div>
            </div>
            
            <div class="card-footer">
                <div class="price-tag">250 ر.س</div>
                <div class="actions-group">
                    <button class="btn-experience" onclick="openVideoModal('safari.mp4', 'رحلة سفاري وكثبان الصحراء', 4)">
                        <i class="fa-solid fa-play"></i> عيش التجربة
                    </button>
                    <button class="btn-book" onclick="addToCart('رحلة سفاري وكثبان الصحراء', 250)">حجز التجربة</button>
                </div>
            </div>
        </div>

        <!-- رحلة 5 -->
        <div class="tour-card">
            <div class="tour-title">جولة مزارع النخيل والعيون</div>
            <div class="location">📍 الموقع: واحة الأحساء التاريخية</div>
            <div class="desc">استمتع بجولة هادئة بين ملايين النخيل والينابيع الطبيعية العذبة مع تذوق التمور المحلية.</div>
            
            <div class="meta-box">
                <div>🧭 <strong>المرشد:</strong> فهد القحطاني (مرشد بيئي واحات)</div>
                <div>⏰ <strong>المدة:</strong> 3 ساعات</div>
            </div>
            
            <div class="card-footer">
                <div class="price-tag">80 ر.س</div>
                <div class="actions-group">
                    <button class="btn-experience" onclick="openVideoModal('ahsa.mp4', 'جولة مزارع النخيل والعيون', 5)">
                        <i class="fa-solid fa-play"></i> عيش التجربة
                    </button>
                    <button class="btn-book" onclick="addToCart('جولة مزارع النخيل والعيون', 80)">حجز التجربة</button>
                </div>
            </div>
        </div>

        <!-- رحلة 6 -->
        <div class="tour-card">
            <div class="tour-title">رحلة بحرية واستكشاف الساحل</div>
            <div class="location">📍 الموقع: ساحل البحر الأحمر - أملج</div>
            <div class="desc">جولة بحرية ساحرة في مياه البحر الأحمر الصافية والتعرف على ثقافة الصيد والبيئة البحرية.</div>
            
            <div class="meta-box">
                <div>🧭 <strong>المرشد:</strong> سالم المري (قائد رحلات بحرية)</div>
                <div>⏰ <strong>المدة:</strong> 5 ساعات</div>
            </div>
            
            <div class="card-footer">
                <div class="price-tag">200 ر.س</div>
                <div class="actions-group">
                    <button class="btn-experience" onclick="openVideoModal('umluj.mp4', 'رحلة بحرية واستكشاف الساحل', 6)">
                        <i class="fa-solid fa-play"></i> عيش التجربة
                    </button>
                    <button class="btn-book" onclick="addToCart('رحلة بحرية واستكشاف الساحل', 200)">حجز التجربة</button>
                </div>
            </div>
        </div>

    </div>

    <!-- نافذة المودل لعرض الفيديوهات -->
    <div id="videoModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <span class="close-btn" onclick="closeVideoModal()">&times;</span>
            <h3 id="modalTitle">عنوان التجربة</h3>
            
            <div class="video-container">
                <video id="localExperienceVideo" controls autoplay>
                    <source src="" type="video/mp4">
                    متصفحك لا يدعم عرض الفيديو.
                </video>
            </div>

            <a id="modalBookingBtn" href="cart.php" class="btn-gold-modal">إضافة للسلة أو متابعة الحجز</a>
        </div>
    </div>

    <script>
        function openVideoModal(videoFile, tourTitle, tourId) {
            const videoElement = document.getElementById('localExperienceVideo');
            videoElement.src = videoFile;
            videoElement.load();
            videoElement.play();

            document.getElementById('modalTitle').innerText = tourTitle;
            document.getElementById('videoModal').style.display = 'flex';
        }

        function closeVideoModal() {
            const videoElement = document.getElementById('localExperienceVideo');
            videoElement.pause();
            videoElement.src = '';
            document.getElementById('videoModal').style.display = 'none';
        }

        // دالة إضافة الرحلة إلى السلة عبر LocalStorage المتوافقة مع cart.php
        function addToCart(title, price) {
            let cart = JSON.parse(localStorage.getItem('safarCart')) || [];
            cart.push({ title: title, price: price });
            localStorage.setItem('safarCart', JSON.stringify(cart));
            alert('تمت إضافة الرحلة إلى سلة الحجوزات بنجاح! 🛒');
        }
    </script>

</body>
</html>
            
           

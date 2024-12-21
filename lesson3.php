<?php
session_start();
if (!isset($_SESSION['userid'])) {
    // ถ้าไม่มีการกำหนด $_SESSION['userid'] ให้เปลี่ยนเส้นทางไปที่หน้า login
    header("Location: testlogin.php");
    exit(); // หยุดการทำงานของ script เพื่อให้แน่ใจว่าจะไม่ประมวลผลโค้ดด้านล่าง
}
?>
<!DOCTYPE html>

<html lang="th">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>	พัฒนาการของแบบจำลองระบบสุริยะ - บทเรียนที่ 3</title>

    <link rel="stylesheet" href="lesson3.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=K2D:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Mali:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">  



</head>

<body>

    <header>

        <h1>บทเรียนที่ 3</h1>

        <p>เรื่อง พัฒนาการของแบบจำลองระบบสุริยะ</p>

    </header>

    <main>

        <section class="content">

            <!-- กล่องเนื้อหาที่ 1 -->

            <div class="card">

                <div class="image">

                    <img src="img/Geocentric.png" alt="ความหมายของดาวบริวาร">

                </div>

                <div class="text">

                    <h2>ระบบโลกเป็นศูนย์กลาง (Geocentric System)</h2>

                    &nbsp;&nbsp;เป็นแนวคิดทางดาราศาสตร์ในอดีตที่เชื่อว่าโลกเป็นจุดศูนย์กลางของจักรวาล โดยดาวเคราะห์ ดวงจันทร์ ดวงอาทิตย์ และดวงดาวทั้งหลายเคลื่อนที่รอบโลก 

                    <br>ซึ่งเป็นความเข้าใจที่สอดคล้องกับการสังเกตด้วยตาเปล่าในยุคโบราณ

                    <div class="sub-boxes">

                        <div class="sub-box">

                        <h3>แนวคิดพื้นฐาน</h3>

                        <p>1.โลกเป็นศูนย์กลางของจักรวาล

                        <br>- โลกถูกมองว่าเป็นศูนย์กลางที่ไม่เคลื่อนที่ 

                        <br>มีความสำคัญสูงสุดในจักรวาล เพราะเป็นที่อยู่อาศัยของมนุษย์และเป็นที่เกิดของเหตุการณ์ต่างๆ </p>

                        <p>2.วัตถุท้องฟ้าเคลื่อนที่เป็นวงกลมสมบูรณ์

                        <br>- เชื่อว่าวัตถุในจักรวาล เช่น ดวงอาทิตย์ <br>และดาวเคราะห์ เคลื่อนที่ในลักษณะวงกลมสมบูรณ์ ซึ่งถือเป็นรูปร่างที่สมบูรณ์แบบและเป็นระเบียบ</p>

                        <p>3.วงโคจรซ้อน (Epicycle)

                        <br>- ใช้แนวคิดวงโคจรซ้อนเพื่ออธิบายปรากฏการณ์ <br>ที่ดาวเคราะห์ดูเหมือนเคลื่อนที่ถอยหลังในบางช่วงของการโคจร เช่น ดาวอังคารที่บางครั้งดูเหมือนหยุดและเคลื่อนถอยหลัง</p>

                        </div>

                        <div class="sub-box">

                        <h3>ความสำคัญในอดีต</h3>

                        <p>1.ความเข้าใจที่สอดคล้องกับการสังเกต

                        <br>- ในยุคโบราณ การมองเห็นวัตถุท้องฟ้า <br>เช่น ดวงอาทิตย์ขึ้นทางทิศตะวันออกและตก <br>ทางทิศตะวันตกในทุกวัน สนับสนุนความคิดว่าโลกอยู่นิ่ง และวัตถุเหล่านั้นเคลื่อนที่รอบโลก</p>

                        <p>2.สนับสนุนความเชื่อทางศาสนา

                        <br>- แนวคิดนี้เข้ากันได้กับความเชื่อทางศาสนา <br>ในยุคกลาง ที่เห็นว่าโลกและมนุษย์มีความสำคัญ <br>และเป็นจุดศูนย์กลางของการสร้างสรรค์ในจักรวาล</p>

                        </div>

                        <div class="sub-box">

                        <h3>แบบจำลองสำคัญ</h3>

                        <p>1.แบบจำลองของอริสโตเติล (Aristotle)

                        <br>- อริสโตเติลเสนอว่าโลกอยู่ที่ศูนย์กลาง <br>และวัตถุท้องฟ้า เช่น ดวงอาทิตย์และดวงดาว <br>อยู่บนทรงกลมโปร่งใสหลายชั้นที่เคลื่อนที่รอบโลก</p>

                        <p>2.แบบจำลองของปโตเลมี (Ptolemy)

                        <br>- ปโตเลมีปรับปรุงแนวคิดของอริสโตเติลโดย <br>เพิ่มวงโคจรซ้อน (Epicycle) เพื่ออธิบายการเคลื่อนถอยหลังของดาวเคราะห์ ทำให้แบบจำลองนี้มีความซับซ้อนแต่สามารถใช้อธิบายปรากฏการณ์บางอย่างได้ดีขึ้น</p>

                        </p>

                        </div>

                        <div class="sub-box">

                        <h3>ข้อจำกัดของแนวคิด</h3>

                        <p>1.ความซับซ้อนของแบบจำลอง

                        <br>- แบบจำลองของปโตเลมีต้องเพิ่มวงโคจรซ้อน <br>หลายชั้นเพื่ออธิบายการเคลื่อนที่ของดาวเคราะห์ ทำให้ยุ่งยากและไม่สามารถใช้งานได้ง่าย</p>

                        <p>2.ขาดความแม่นยำ

                        <br>- แบบจำลองไม่สามารถอธิบายปรากฏการณ์ <br>บางอย่าง เช่น ระยะเปลี่ยนแสงของดาวศุกร์ <br>หรือการเคลื่อนที่ของดวงจันทร์ของดาวเคราะห์ <br>ได้อย่างสมบูรณ์</p>

                        

                        </div>

                        <div class="sub-box">

                        <h3>การล่มสลายของระบบโลกเป็นศูนย์กลาง</h3>

                        <p>1.ระบบดวงอาทิตย์เป็นศูนย์กลาง (Heliocentric System)

                        <br>- ในศตวรรษที่ 16 นิโคลัส โคเปอร์นิคัสเสนอแนวคิดว่าดวงอาทิตย์อยู่ที่ศูนย์กลาง ซึ่งสามารถอธิบายปรากฏการณ์ต่างๆ ได้แม่นยำกว่า </p>

                        <p>2.การค้นพบโดยกาลิเลโอ กาลิเลอี

                        <br>- กาลิเลโอใช้กล้องโทรทรรศน์สังเกตพบดวงจันทร์ของดาวพฤหัสบดีที่โคจรรอบดาวพฤหัสบดี ไม่ใช่รอบโลก และระยะเปลี่ยนแสงของดาวศุกร์ที่ยืนยันว่าดาวศุกร์โคจรรอบดวงอาทิตย์</p>

                        </div>

                        <div class="sub-box">

                        <h3>ประโยชน์ต่อการศึกษาในปัจจุบัน</h3>

                        <p>1.เข้าใจพัฒนาการทางดาราศาสตร์

                        <br>- ระบบโลกเป็นศูนย์กลางแสดงถึงความพยายามในอดีตของมนุษย์ในการทำความเข้าใจกับปรากฏการณ์ในจักรวาล</p>

                        <p>2.ส่งเสริมการเรียนรู้เกี่ยวกับการสังเกตท้องฟ้า

                        <br>- แนวคิดนี้ยังใช้เป็นพื้นฐานในการสอนประวัติศาสตร์ดาราศาสตร์ และกระตุ้นความสนใจในเรื่องการศึกษาท้องฟ้า</p>

                    </div>

                    </div>

                </div>

            </div>

            </div>

           

        </section>

    </main>

    

    <div class="home-button">

        <a href="Start.php" class="nav-btn menu-btn">Home</a>

      </div>

    

    <!-- ปุ่มย้อนกลับและถัดไป -->

      <div class="nav-buttons">

        <a href="game2.html" class="nav-btn" title="ย้อนกลับ">&#8592;</a>

        <a href="lesson3_2.html" class="nav-btn" title="ถัดไป">&#8594;</a>

      </div>

    

    <footer>

        <p>© 2024 บทเรียนระบบสุริยะ | สร้างด้วยความรักต่อจักรวาล</p>

    </footer>

</body>

</html>

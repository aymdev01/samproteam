<?php
// التحقق إذا كان المستخدم قد أرسل id2
if (isset($_GET['id2'])) {
    // استلام قيمة id2 من المستخدم
    $id2 = $_GET['id2'];

    // رابط JSON
    $url = "https://opensheet.elk.sh/1PttLvD6duqEDSGUGpkvMKHUdAK77BekehOVFK56J1lI/1";

    // جلب محتوى JSON
    $json_data = file_get_contents($url);

    // تحويل JSON إلى مصفوفة
    $data = json_decode($json_data, true);

    // مصفوفة لتخزين النتائج
    $results = [];

    // البحث عن كل الصفوف التي تطابق id2
    foreach ($data as $item) {
        if (isset($item['id2']) && $item['id2'] == $id2) {
            $results[] = $item;
        }
    }

    // عرض النتيجة
    if (!empty($results)) {
        // عرض البيانات في شكل JSON
        header('Content-Type: application/json');
        echo json_encode($results);
    } else {
        // إذا لم يتم العثور على أي سجلات
        echo json_encode(['error' => 'لا توجد بيانات تطابق هذا id2.']);
    }
} else {
    // إذا لم يتم إرسال id2
    echo json_encode(['error' => 'يرجى إرسال id2 في الطلب.']);
}
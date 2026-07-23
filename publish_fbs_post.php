<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BlogPost;
use App\Models\BlogCategory;

// 1. Ensure "Clinical Laboratory" Category exists
$category = BlogCategory::firstOrCreate(
    ['slug' => 'clinical-laboratory'],
    ['name' => 'Clinical Laboratory & Diagnostics']
);

// 2. English Styled Content (Paper Theme)
$content_en = <<<HTML
<div class="paper-post-body" style="font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: #1c1917; line-height: 1.8; font-size: 1.05rem;">
    
    <!-- Hero / Abstract Card -->
    <div style="background-color: #f7f4ee; border-left: 4px solid #0f766e; padding: 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
        <h3 style="margin-top: 0; color: #0f766e; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; items-center; gap: 0.5rem;">
            📌 1. Short Introduction &amp; Abstract
        </h3>
        <p style="margin-bottom: 0; color: #44403c; font-size: 1rem;">
            Fasting Blood Sugar (FBS) is one of the most frequently requested laboratory tests worldwide. It measures the concentration of glucose in venous plasma after a period of fasting (typically 8–12 hours). As a frontline screening and monitoring tool for diabetes mellitus, FBS plays a critical role in early detection, treatment follow-up, and preventing long-term complications. This post walks through the standard procedure and key considerations for medical laboratory professionals.
        </p>
    </div>

    <!-- Objectives -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🎯 2. Objective of the Test
    </h2>
    <ul style="list-style: none; padding-left: 0; margin-bottom: 1.75rem;">
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Screen for diabetes mellitus and prediabetes.
        </li>
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Monitor glycemic control in known diabetic patients.
        </li>
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Assess glucose metabolism in patients with metabolic syndrome, obesity, or family history of diabetes.
        </li>
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Part of routine health check-ups and pre-operative assessments.
        </li>
    </ul>

    <!-- Principle Box -->
    <div style="background-color: #fdfbf7; border: 1px solid #e7e2d8; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem;">
        <h3 style="margin-top: 0; color: #1e3a8a; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.75rem;">
            🧪 3. Principle of the Test
        </h3>
        <p style="color: #334155; margin-bottom: 1rem;">
            Glucose in the sample is measured enzymatically using <strong>glucose oxidase (GOD)</strong> or <strong>hexokinase</strong> methods. In the GOD method:
        </p>
        <div style="background-color: #f3efe6; border-radius: 0.5rem; padding: 1rem; font-family: monospace; font-size: 1rem; color: #0f172a; text-align: center; font-weight: 700; border: 1px dashed #d6cebe; margin-bottom: 1rem;">
            Glucose + O₂  &rarr;  Gluconic acid + H₂O₂
        </div>
        <p style="color: #475569; font-size: 0.95rem; margin-bottom: 0;">
            Hydrogen peroxide reacts with a chromogen (e.g., 4-aminoantipyrine and phenol) in the presence of <strong>peroxidase (POD)</strong> to produce a colored complex. The intensity of the color is directly proportional to glucose concentration, measured photometrically at 500–546 nm.
        </p>
    </div>

    <!-- Equipment List -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🔬 4. Equipment
    </h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.85rem; margin-bottom: 2rem;">
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 500;">Automated chemistry analyzer (e.g., Cobas, Architect, BS-200)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 500;">Centrifuge (for plasma/serum separation)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 500;">Refrigerator (2–8 &deg;C) for reagent storage</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 500;">Micropipettes and tips</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 500;">Cuvettes or reaction cells</div>
    </div>

    <!-- Reagent Preparation -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🧪 5. Reagent Preparation
    </h2>
    <ul style="list-style: circle; padding-left: 1.25rem; margin-bottom: 2rem; color: #374151;">
        <li style="margin-bottom: 0.5rem;">Most commercial GOD-POD kits are <strong>ready-to-use liquid reagents</strong>.</li>
        <li style="margin-bottom: 0.5rem;">If lyophilized, reconstitute with the supplied buffer, mix gently, and let stand for 15–30 minutes at room temperature before use.</li>
        <li style="margin-bottom: 0.5rem;">Always check lot number, expiry date, and calibrator requirements before each run.</li>
    </ul>

    <!-- Sample Preparation Table -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🩸 6. Sample Type and Preparation
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700; width: 30%;">Parameter</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Details</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">Sample type</td>
                    <td style="padding: 0.85rem 1.25rem; color: #44403c;">Venous plasma (fluoride oxalate tube — gray top) or serum</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">Fasting requirement</td>
                    <td style="padding: 0.85rem 1.25rem; color: #44403c;">8–12 hours of fasting (water only)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">Handling</td>
                    <td style="padding: 0.85rem 1.25rem; color: #44403c;">Separate plasma/serum within 30 minutes; stable 8 hours at RT, 72 hours at 2–8 &deg;C</td>
                </tr>
                <tr>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">Interferences</td>
                    <td style="padding: 0.85rem 1.25rem; color: #b91c1c;">Hemolysis, prolonged storage, or improper tube mixing can falsely lower results</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Procedure Steps Table -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📋 7. Procedure Steps
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700; width: 15%;">Step</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;"><td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 1</td><td style="padding: 0.85rem 1.25rem;">Label tubes, centrifuge at 3000–3500 rpm for 10 minutes</td></tr>
                <tr style="border-bottom: 1px solid #f1f0ec;"><td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 2</td><td style="padding: 0.85rem 1.25rem;">Calibrate the analyzer using manufacturer calibrator and controls (normal &amp; pathological)</td></tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;"><td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 3</td><td style="padding: 0.85rem 1.25rem;">Pipette sample (e.g., 10 &micro;L) into reaction cuvette</td></tr>
                <tr style="border-bottom: 1px solid #f1f0ec;"><td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 4</td><td style="padding: 0.85rem 1.25rem;">Add working reagent (e.g., 1000 &micro;L) according to kit instructions</td></tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;"><td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 5</td><td style="padding: 0.85rem 1.25rem;">Mix gently and incubate at 37 &deg;C for 10–15 minutes — or allow 5 minutes at RT depending on protocol</td></tr>
                <tr style="border-bottom: 1px solid #f1f0ec;"><td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 6</td><td style="padding: 0.85rem 1.25rem;">Measure absorbance at 500–546 nm against reagent blank</td></tr>
                <tr style="background-color: #faf9f6;"><td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 7</td><td style="padding: 0.85rem 1.25rem;">Calculate glucose concentration using calibration curve or factor</td></tr>
            </tbody>
        </table>
    </div>

    <!-- Result Interpretation -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📊 8. Result Interpretation
    </h2>
    <div style="overflow-x: auto; margin-bottom: 1.5rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Result Range</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Interpretation</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #f0fdf4;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #15803d;">&lt; 100 mg/dL (&lt; 5.6 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #166534;">Normal fasting glucose</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #fffbeb;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #b45309;">100–125 mg/dL (5.6–6.9 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #92400e;">Impaired fasting glucose (Prediabetes)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #fef2f2;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #b91c1c;">&ge; 126 mg/dL (&ge; 7.0 mmol/L) on 2 separate occasions</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #991b1b;">Diabetes mellitus</td>
                </tr>
                <tr style="background-color: #eff6ff;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #1d4ed8;">&lt; 70 mg/dL (&lt; 3.9 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1e40af;">Hypoglycemia (requires clinical correlation)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Normal Ranges -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📐 9. Normal Ranges and Units
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">System</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Normal Range</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600;">mg/dL (Most common in Sudan, USA)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">70–99 mg/dL</td>
                </tr>
                <tr>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600;">mmol/L (International, UK, Canada)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">3.9–5.5 mmol/L</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Final Comment -->
    <div style="background-color: #faf8f5; border: 1px solid #e7e2d8; border-radius: 0.75rem; padding: 1.25rem 1.5rem; margin-bottom: 2rem;">
        <h3 style="margin-top: 0; color: #7c2d12; font-size: 1.15rem; font-weight: 700; margin-bottom: 0.5rem;">
            💡 10. Final Comment &amp; Clinical Context
        </h3>
        <p style="margin-bottom: 0; color: #44403c; font-size: 0.98rem;">
            FBS remains a cornerstone of diabetes screening, but it has limitations. It only reflects glucose at a single point in time and can be affected by acute stress, short-term fasting compliance, and recent illness. For long-term monitoring, <strong>HbA1c offers a 2–3 month overview</strong> and is a superior tool in follow-up settings.
        </p>
    </div>

</div>
HTML;

// 3. Arabic Styled Content
$content_ar = <<<HTML
<div class="paper-post-body" dir="rtl" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1c1917; line-height: 1.9; font-size: 1.05rem;">
    
    <!-- Hero / Abstract Card -->
    <div style="background-color: #f7f4ee; border-right: 4px solid #0f766e; padding: 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
        <h3 style="margin-top: 0; color: #0f766e; font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem;">
            📌 1. مقدمة موجزة
        </h3>
        <p style="margin-bottom: 0; color: #44403c; font-size: 1rem;">
            فحص سكر الصائم (Fasting Blood Sugar — FBS) هو أحد أكثر التحاليل المخبرية طلبًا في العالم. يقيس هذا الفحص تركيز الجلوكوز في بلازما الدم الوريدي بعد فترة صيام تتراوح بين 8–12 ساعة. ويُعد أداة خط أمامي في الكشف المبكر عن داء السكري ومتابعة العلاج والوقاية من المضاعفات المزمنة. يقدم هذا المنشور شرحًا تفصيليًا للإجراء المخبري القياسي وأهم الاعتبارات العملية لأخصائيي المختبرات الطبية.
        </p>
    </div>

    <!-- Objectives -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🎯 2. أهداف الفحص
    </h2>
    <ul style="list-style: none; padding-right: 0; margin-bottom: 1.75rem;">
        <li style="position: relative; padding-right: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; right: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            الكشف عن داء السكري (Diabetes Mellitus) ومرحلة ما قبل السكري (Prediabetes).
        </li>
        <li style="position: relative; padding-right: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; right: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            متابعة السيطرة على سكر الدم لدى مرضى السكري المعروفين.
        </li>
        <li style="position: relative; padding-right: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; right: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            تقييم استقلاب الجلوكوز لدى المرضى الذين يعانون من متلازمة الأيض أو السمنة أو التاريخ العائلي للسكري.
        </li>
        <li style="position: relative; padding-right: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; right: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            جزء من الفحوصات الدورية والتقييمات قبل العمليات الجراحية.
        </li>
    </ul>

    <!-- Principle Box -->
    <div style="background-color: #fdfbf7; border: 1px solid #e7e2d8; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem;">
        <h3 style="margin-top: 0; color: #1e3a8a; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.75rem;">
            🧪 3. مبدأ الفحص (Principle)
        </h3>
        <p style="color: #334155; margin-bottom: 1rem;">
            يُقاس الجلوكوز في العينة إنزيميًا بطريقة <strong>Glucose Oxidase (GOD)</strong> أو <strong>Hexokinase</strong>. في طريقة GOD:
        </p>
        <div dir="ltr" style="background-color: #f3efe6; border-radius: 0.5rem; padding: 1rem; font-family: monospace; font-size: 1rem; color: #0f172a; text-align: center; font-weight: 700; border: 1px dashed #d6cebe; margin-bottom: 1rem;">
            Glucose + O₂  &rarr;  Gluconic acid + H₂O₂
        </div>
        <p style="color: #475569; font-size: 0.95rem; margin-bottom: 0;">
            يتفاعل فوق أكسيد الهيدروجين (H₂O₂) مع كروموجين (مثل 4-aminoantipyrine والفينول) بوجود إنزيم <strong>Peroxidase (POD)</strong> ليكون مركبًا ملونًا. شدة اللون تتناسب طرديًا مع تركيز الجلوكوز، ويُقاس قياسًا ضوئيًا عند طول موجي 500–546 نانومتر.
        </p>
    </div>

    <!-- Equipment -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🔬 4. المعدات
    </h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.85rem; margin-bottom: 2rem;">
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">محلل كيميائي آلي (Cobas, Architect, BS-200)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">جهاز طرد مركزي (Centrifuge)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">ثلاجة (2–8 &deg;C) لحفظ الكواشف</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">ميكروبيبت ورؤوس ماصة (Tips)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">كوفيتات أو خلايا تفاعل</div>
    </div>

    <!-- Sample Table -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🩸 6. نوع العينة وتحضيرها
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: right; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700; width: 30%;">المعامل</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">التفاصيل</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700;">نوع العينة</td>
                    <td style="padding: 0.85rem 1.25rem;">بلازما وريدية (أنبوب فلورايد أوكسالات — الغطاء الرمادي) أو مصل (Serum)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700;">اشتراط الصيام</td>
                    <td style="padding: 0.85rem 1.25rem;">8–12 ساعة صيام (الماء فقط مسموح)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700;">التعامل مع العينة</td>
                    <td style="padding: 0.85rem 1.25rem;">فصل البلازما أو المصل خلال 30 دقيقة؛ ثبات 8 ساعات في حرارة الغرفة، 72 ساعة في 2–8 &deg;C</td>
                </tr>
                <tr>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700;">عوامل التداخل</td>
                    <td style="padding: 0.85rem 1.25rem; color: #b91c1c;">انحلال الدم أو التخزين الطويل أو الخلط غير السليم للأنبوب يؤدي إلى نتائج منخفضة خاطئة</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Interpretation Table -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📊 8. تفسير النتائج
    </h2>
    <div style="overflow-x: auto; margin-bottom: 1.5rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: right; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">نطاق النتيجة</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">التفسير</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #f0fdf4;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #15803d;" dir="ltr">&lt; 100 mg/dL (&lt; 5.6 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #166534;">سكر صائم طبيعي</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #fffbeb;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #b45309;" dir="ltr">100–125 mg/dL (5.6–6.9 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #92400e;">ضعف سكر الصائم — مرحلة ما قبل السكري (Prediabetes)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #fef2f2;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #b91c1c;" dir="ltr">&ge; 126 mg/dL (&ge; 7.0 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #991b1b;">داء السكري (في مناسبتين منفصلتين)</td>
                </tr>
                <tr style="background-color: #eff6ff;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #1d4ed8;" dir="ltr">&lt; 70 mg/dL (&lt; 3.9 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #1e40af;">هبوط سكر الدم (Hypoglycemia) — يتطلب تقييمًا سريريًا</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Final Comment -->
    <div style="background-color: #faf8f5; border: 1px solid #e7e2d8; border-radius: 0.75rem; padding: 1.25rem 1.5rem; margin-bottom: 2rem;">
        <h3 style="margin-top: 0; color: #7c2d12; font-size: 1.15rem; font-weight: 700; margin-bottom: 0.5rem;">
            💡 10. تعليق ختامي
        </h3>
        <p style="margin-bottom: 0; color: #44403c; font-size: 0.98rem;">
            يبقى فحص FBS حجر الزاوية في كشف السكري، لكن له حدودًا. فهو يعكس مستوى الجلوكوز في نقطة زمنية واحدة فقط، ويمكن أن يتأثر بالإجهاد الحاد، والالتزام بالصيام قصير الأمد. للمتابعة طويلة الأمد، يُعد <strong>HbA1c</strong> خيارًا متفوقًا لأنه يعطي صورة لمتوسط السكر خلال 2–3 أشهر.
        </p>
    </div>

</div>
HTML;

// 4. Somali Styled Content
$content_so = <<<HTML
<div class="paper-post-body" style="font-family: system-ui, -apple-system, sans-serif; color: #1c1917; line-height: 1.8; font-size: 1.05rem;">
    
    <!-- Hero / Abstract Card -->
    <div style="background-color: #f7f4ee; border-left: 4px solid #0f766e; padding: 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
        <h3 style="margin-top: 0; color: #0f766e; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">
            📌 1. Hordhac Kooban &amp; nuxurka
        </h3>
        <p style="margin-bottom: 0; color: #44403c; font-size: 1rem;">
            Baaritaanka Fasting Blood Sugar (FBS) (baaritaanka sonkorota soonka) waa mid ka mid ah baaritaannada shaybaarka ee ugu badan adduunka. Wuxuu cabbiraa heerka glucose ee balasmaha dhiigga ka dib soon dhererkiisu yahay 8–12 saacadood. Baaritaankani waa qalab muhiim u ah baarista hore iyo la socodka cudurka sonkorota (Diabetes Mellitus).
        </p>
    </div>

    <!-- Objectives -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🎯 2. Ujeedada Baaritaanka
    </h2>
    <ul style="list-style: none; padding-left: 0; margin-bottom: 1.75rem;">
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Baarista cudurka sonkorota (Diabetes Mellitus) iyo heerka kahor-sonkorota (Prediabetes).
        </li>
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            La socodka heerka sonkorta bukaannada sonkorota ee daaweynta ku jira.
        </li>
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Qiimaynta habka sonkorota ee jirka (glucose metabolism) bukaannada qaba cudurka dheef-shiidka ama taariikhda qoyska.
        </li>
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Qayb ka mid ah baaritaannada caadiga ah iyo qiimaynta qalliinka kahor.
        </li>
    </ul>

    <!-- Principle Box -->
    <div style="background-color: #fdfbf7; border: 1px solid #e7e2d8; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem;">
        <h3 style="margin-top: 0; color: #1e3a8a; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.75rem;">
            🧪 3. Mabda'a (Principle)
        </h3>
        <p style="color: #334155; margin-bottom: 1rem;">
            Glucose waxaa lagu cabbiraa habka <strong>Glucose Oxidase (GOD)</strong> ama <strong>Hexokinase</strong>. Habka GOD:
        </p>
        <div style="background-color: #f3efe6; border-radius: 0.5rem; padding: 1rem; font-family: monospace; font-size: 1rem; color: #0f172a; text-align: center; font-weight: 700; border: 1px dashed #d6cebe; margin-bottom: 1rem;">
            Glucose + O₂  &rarr;  Gluconic acid + H₂O₂
        </div>
        <p style="color: #475569; font-size: 0.95rem; margin-bottom: 0;">
            Hydrogen peroxide (H₂O₂) ayaa la falgala chromogen iyadoo ay joogto <strong>Peroxidase (POD)</strong>, taasoo soo saarta midab leh casaan/bunni. Xoojinta midabka waxaa lagu cabbiraa photometer 500–546 nm.
        </p>
    </div>

    <!-- Equipment List -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🔬 4. Qalabka (Equipment)
    </h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.85rem; margin-bottom: 2rem;">
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">Makiinada shaybaarka otomaatiga ah (Cobas, Architect, BS-200)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">Makiinada centrifugation (Centrifuge)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">Qaboojiye (2–8 &deg;C) kaydinta kiimikada</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">Micropipettes iyo tips</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">Cuvettes ama Reaction Cells</div>
    </div>

    <!-- Procedure Steps Table -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📋 7. Nidaamka Shaqada (Procedure)
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700; width: 20%;">Tallaabada</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Ficilka</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;"><td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Tallaabada 1</td><td style="padding: 0.85rem 1.25rem;">Ku calaamadee tuubbabada, ku wareeji centrifuge 3000–3500 rpm muddo 10 daqiiqo</td></tr>
                <tr style="border-bottom: 1px solid #f1f0ec;"><td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Tallaabada 2</td><td style="padding: 0.85rem 1.25rem;">Makiinadda ku Calibrate iyadoo la isticmaalayo calibrator iyo controls (normal &amp; pathological)</td></tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;"><td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Tallaabada 3</td><td style="padding: 0.85rem 1.25rem;">Ku soo qaad muunadda (tusaale 10 &micro;L) weelka falcelinta (cuvette)</td></tr>
                <tr style="border-bottom: 1px solid #f1f0ec;"><td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Tallaabada 4</td><td style="padding: 0.85rem 1.25rem;">Ku dar kiimikada shaqada (reagent 1000 &micro;L) sida ku qoran kit-ka</td></tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;"><td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Tallaabada 5</td><td style="padding: 0.85rem 1.25rem;">Si fiican isku qas, ku Incubate 37 &deg;C muddo 10–15 daqiiqo</td></tr>
            </tbody>
        </table>
    </div>

</div>
HTML;

// 5. Build post payload
$data = [
    'title_en' => 'Fasting Blood Sugar (FBS) — Standard Clinical Laboratory Procedure',
    'title_ar' => 'فحص سكر الصائم (FBS) — الإجراء المخبري القياسي',
    'title_so' => 'Baaritaanka Sonkorota ee Soonka (FBS) — Nidaamka Shaqada Shaybaarka',
    'slug' => 'fasting-blood-sugar-fbs-standard-procedure',
    'excerpt_en' => 'Standard operating procedure for Fasting Blood Sugar (FBS) testing, including test objectives, enzymatic GOD-POD principle, sample preparation, and clinical result interpretation.',
    'excerpt_ar' => 'الدليل الإجرائي القياسي الشامل لفحص سكر الدم الصائم (FBS)، يشمل مبدأ التفاعل الكيميائي، خطوات العمل المخبري، وتفسير النتائج السريرية.',
    'excerpt_so' => 'Nidaamka borotokoolka shaybaarka ee baaritaanka sonkorta soonka (FBS), oo sheegaya ujeedada, mabda\'a GOD-POD, diyaarinta muunadda iyo qiimaynta natiijooyinka.',
    'content_en' => $content_en,
    'content_ar' => $content_ar,
    'content_so' => $content_so,
    'is_published' => true,
    'blog_category_id' => $category->id,
    'featured_image_url' => 'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=1200&q=80',
];

// 6. Save directly to Database using Spatie Translatable BlogPost model
$post = BlogPost::firstOrNew(['slug' => $data['slug']]);

$post->setTranslation('title', 'en', $data['title_en']);
$post->setTranslation('title', 'ar', $data['title_ar']);
$post->setTranslation('title', 'so', $data['title_so']);

$post->setTranslation('excerpt', 'en', $data['excerpt_en']);
$post->setTranslation('excerpt', 'ar', $data['excerpt_ar']);
$post->setTranslation('excerpt', 'so', $data['excerpt_so']);

$post->setTranslation('content', 'en', $data['content_en']);
$post->setTranslation('content', 'ar', $data['content_ar']);
$post->setTranslation('content', 'so', $data['content_so']);

$post->slug = $data['slug'];
$post->is_published = true;
$post->blog_category_id = $category->id;
$post->featured_image_url = $data['featured_image_url'];

$post->save();

echo "Post successfully saved with ID: " . $post->id . "\n";

// 7. Save template payload JSON for OpenClaw / Future automation
file_put_contents(__DIR__ . '/fbs_post_template.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Template payload saved to fbs_post_template.json\n";

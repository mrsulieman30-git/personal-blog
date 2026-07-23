<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BlogPost;
use App\Models\BlogCategory;

// 1. Ensure Category
$category = BlogCategory::firstOrCreate(
    ['slug' => 'clinical-laboratory'],
    ['name' => 'Clinical Laboratory & Diagnostics']
);

// -----------------------------------------------------------------------------
// 2. ENGLISH CONTENT
// -----------------------------------------------------------------------------
$content_en = <<<HTML
<div class="paper-post-body" style="font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: #1c1917; line-height: 1.8; font-size: 1.05rem;">
    
    <!-- Abstract Box -->
    <div style="background-color: #f7f4ee; border-left: 4px solid #0f766e; padding: 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
        <h3 style="margin-top: 0; color: #0f766e; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">
            📌 1. Short Introduction &amp; Abstract
        </h3>
        <p style="margin-bottom: 0; color: #44403c; font-size: 1rem;">
            Fasting Blood Sugar (FBS) is one of the most essential clinical chemistry tests conducted in diagnostic laboratories worldwide. It measures venous plasma glucose concentration following an 8 to 12-hour overnight fast. As a primary diagnostic tool for Diabetes Mellitus and metabolic disorders, accurate measurement of FBS is vital for early disease screening, therapeutic monitoring, and risk mitigation against chronic microvascular and macrovascular complications.
        </p>
    </div>

    <!-- Objectives -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🎯 2. Objective of the Test
    </h2>
    <ul style="list-style: none; padding-left: 0; margin-bottom: 1.75rem;">
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Screening and diagnosis of Diabetes Mellitus and Impaired Fasting Glucose (Prediabetes).
        </li>
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Monitoring therapeutic efficacy and glycemic control in established diabetic patients.
        </li>
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Evaluating carbohydrate metabolism in patients with Metabolic Syndrome, gestational risk, obesity, or endocrine disorders.
        </li>
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Essential component of routine executive health check-ups and pre-operative clinical profiles.
        </li>
    </ul>

    <!-- Enzymatic Principle -->
    <div style="background-color: #fdfbf7; border: 1px solid #e7e2d8; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem;">
        <h3 style="margin-top: 0; color: #1e3a8a; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.75rem;">
            🧪 3. Enzymatic Reaction Principle (GOD-POD Method)
        </h3>
        <p style="color: #334155; margin-bottom: 1rem;">
            Glucose in the specimen is oxidized by <strong>Glucose Oxidase (GOD)</strong> to gluconic acid and hydrogen peroxide. Hydrogen peroxide then reacts with 4-aminoantipyrine (4-AAP) and phenol in the presence of <strong>Peroxidase (POD)</strong> to yield a red/pink quinoneimine dye.
        </p>
        <div style="background-color: #f3efe6; border-radius: 0.5rem; padding: 1rem; font-family: monospace; font-size: 0.95rem; color: #0f172a; text-align: center; font-weight: 700; border: 1px dashed #d6cebe; margin-bottom: 1rem; line-height: 1.6;">
            Glucose + O₂ + H₂O &nbsp;&xrightarrow{\text{GOD}}&nbsp; Gluconic Acid + H₂O₂<br>
            2 H₂O₂ + 4-AAP + Phenol &nbsp;&xrightarrow{\text{POD}}&nbsp; Quinoneimine Dye (Pink/Red) + 4 H₂O
        </div>
        <p style="color: #475569; font-size: 0.95rem; margin-bottom: 0;">
            The absorbance intensity of the quinoneimine complex is directly proportional to the glucose concentration in the sample, measured photometrically at <strong>500 nm (range 492–550 nm)</strong> against a reagent blank.
        </p>
    </div>

    <!-- Equipment List -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🔬 4. Laboratory Equipment &amp; Instruments
    </h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 0.85rem; margin-bottom: 2rem;">
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 500;">Automated / Semi-automated Chemistry Analyzer (Cobas, Architect, BS series)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 500;">Clinical Centrifuge (3000–3500 RPM / 1500 RCF)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 500;">Water bath / Incubator maintained at 37 &deg;C (&plusmn;0.5 &deg;C)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 500;">Calibrated Micropipettes (10 &micro;L &amp; 1000 &micro;L) with aerosol barrier tips</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 500;">Reagent grade cuvettes / micro-cells and timer</div>
    </div>

    <!-- Reagent Preparation -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🧪 5. Reagent Preparation &amp; Stability
    </h2>
    <ul style="list-style: circle; padding-left: 1.25rem; margin-bottom: 2rem; color: #374151;">
        <li style="margin-bottom: 0.5rem;">Most commercial GOD-POD kits are provided as liquid ready-to-use (RTU) mono-reagents.</li>
        <li style="margin-bottom: 0.5rem;">If using bi-reagent or lyophilized formats, reconstitute precisely according to kit protocol and allow 15–30 minutes at room temperature (15–25 &deg;C) for equilibration.</li>
        <li style="margin-bottom: 0.5rem;">Reagents are stable up to expiration date when stored at <strong>2–8 &deg;C</strong> protected from direct sunlight. Do not freeze or use if reagent blank absorbance at 500 nm exceeds 0.100 AU.</li>
    </ul>

    <!-- Sample Handling Table -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🩸 6. Sample Type &amp; Pre-analytical Considerations
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700; width: 28%;">Parameter</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Details &amp; Protocol</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">Sample Specimen</td>
                    <td style="padding: 0.85rem 1.25rem; color: #44403c;">Venous Plasma in Sodium Fluoride / Potassium Oxalate tube (Gray Top) or Serum</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">Fasting Requirement</td>
                    <td style="padding: 0.85rem 1.25rem; color: #44403c;">Strict 8–12 hours overnight fasting (water intake permitted)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">In vitro Glycolysis Inhibition</td>
                    <td style="padding: 0.85rem 1.25rem; color: #44403c;">Fluoride inhibits enolase to prevent glucose decay (~5–7% loss per hour in unseparated blood at room temp)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">Stability &amp; Storage</td>
                    <td style="padding: 0.85rem 1.25rem; color: #44403c;">Separated plasma is stable 8 hours at 15–25 &deg;C, 72 hours at 2–8 &deg;C, or 30 days frozen at -20 &deg;C</td>
                </tr>
                <tr>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">Pre-analytical Interferences</td>
                    <td style="padding: 0.85rem 1.25rem; color: #b91c1c;">Gross hemolysis (hemoglobin &gt;500 mg/dL), severe lipemia, or delayed centrifugation cause erroneous results</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Complete 7-Step Procedure Table -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📋 7. Complete Step-by-Step Procedure
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700; width: 14%;">Step</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Action &amp; Operational Protocol</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 1</td>
                    <td style="padding: 0.85rem 1.25rem;">Verify patient identity, label tubes, and centrifuge specimen at 3000–3500 RPM for 10 minutes to separate clear plasma/serum.</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 2</td>
                    <td style="padding: 0.85rem 1.25rem;">Calibrate chemistry analyzer using standard/calibrator and run two levels of Quality Control (Normal Level 1 &amp; Pathological Level 2).</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 3</td>
                    <td style="padding: 0.85rem 1.25rem;">Pipette 10 &micro;L of Reagent Blank (distilled water), Standard (100 mg/dL), and Patient Sample into labeled reaction cuvettes.</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 4</td>
                    <td style="padding: 0.85rem 1.25rem;">Dispense 1000 &micro;L (1.0 mL) of GOD-POD Working Reagent into each cuvette and mix thoroughly by gentle inversion.</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 5</td>
                    <td style="padding: 0.85rem 1.25rem;"><strong>Incubate reaction tubes for 10–15 minutes at 37 &deg;C</strong> in a water bath / analyzer incubator OR <strong>20–30 minutes at Room Temperature (15–25 &deg;C)</strong>.</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 6</td>
                    <td style="padding: 0.85rem 1.25rem;">Zero photometer with Reagent Blank and measure absorbance of Standard (A_std) and Samples (A_sample) at 500 nm within 30 minutes.</td>
                </tr>
                <tr style="background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Step 7</td>
                    <td style="padding: 0.85rem 1.25rem;">Calculate concentration: Glucose (mg/dL) = (A_sample / A_std) &times; Standard Concentration (100 mg/dL). Verify linearity limit (up to 500 mg/dL).</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Result Interpretation -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📊 8. Result Interpretation (ADA Guidelines)
    </h2>
    <div style="overflow-x: auto; margin-bottom: 1.5rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Result Range</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Clinical Interpretation</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #f0fdf4;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #15803d;">&lt; 100 mg/dL (&lt; 5.6 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #166534;">Normal Fasting Glucose</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #fffbeb;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #b45309;">100–125 mg/dL (5.6–6.9 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #92400e;">Impaired Fasting Glucose (Prediabetes)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #fef2f2;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #b91c1c;">&ge; 126 mg/dL (&ge; 7.0 mmol/L) on 2 separate days</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #991b1b;">Provisional Diagnosis of Diabetes Mellitus</td>
                </tr>
                <tr style="background-color: #eff6ff;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #1d4ed8;">&lt; 70 mg/dL (&lt; 3.9 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1e40af;">Hypoglycemia (Critical alert value requiring urgent evaluation)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Reference Ranges & Units -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📐 9. Normal Reference Ranges &amp; Unit Conversion
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">System / Region</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Normal Reference Range</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600;">mg/dL (Sudan, USA, Middle East)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">70–99 mg/dL</td>
                </tr>
                <tr>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600;">mmol/L (International SI Units, UK, Canada)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">3.9–5.5 mmol/L</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Final Comment -->
    <div style="background-color: #faf8f5; border: 1px solid #e7e2d8; border-radius: 0.75rem; padding: 1.25rem 1.5rem; margin-bottom: 2rem;">
        <h3 style="margin-top: 0; color: #7c2d12; font-size: 1.15rem; font-weight: 700; margin-bottom: 0.5rem;">
            💡 10. Clinical Comment &amp; Diagnostic Limitations
        </h3>
        <p style="margin-bottom: 0; color: #44403c; font-size: 0.98rem;">
            While FBS is indispensable for screening, single measurements can be influenced by acute stress, exercise, circadian variation, and fasting non-compliance. For comprehensive long-term glycemic control evaluation, <strong>Glycated Hemoglobin (HbA1c)</strong> provides an accurate 2–3 month average glycemia index without fasting requirements.
        </p>
    </div>

</div>
HTML;

// -----------------------------------------------------------------------------
// 3. ARABIC CONTENT (FULL SCIENTIFIC TRANSLATION)
// -----------------------------------------------------------------------------
$content_ar = <<<HTML
<div class="paper-post-body" dir="rtl" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1c1917; line-height: 1.9; font-size: 1.05rem;">
    
    <!-- Abstract Box -->
    <div style="background-color: #f7f4ee; border-right: 4px solid #0f766e; padding: 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
        <h3 style="margin-top: 0; color: #0f766e; font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem;">
            📌 1. مقدمة موجزة
        </h3>
        <p style="margin-bottom: 0; color: #44403c; font-size: 1rem;">
            فحص سكر الصائم (Fasting Blood Sugar — FBS) هو أحد أكثر التحاليل الكيميائية السريرية طلبًا في المختبرات الطبية عالميًا. يقيس هذا التحليل تركيز الجلوكوز في بلازما الدم الوريدي بعد صيام ليلى تتراوح مدته بين 8 إلى 12 ساعة. وباعتباره الفحص التشخيصي الأول لداء السكري واضطرابات الأيض، فإن القياس الدقيق لنسبة سكر الصائم يُعد حاسمًا للكشف المبكر، ومتابعة الاستجابة العلاجية، والحد من الخطر المستقبلي للمضاعفات الوعائية المزمنة.
        </p>
    </div>

    <!-- Objectives -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🎯 2. أهداف الفحص
    </h2>
    <ul style="list-style: none; padding-right: 0; margin-bottom: 1.75rem;">
        <li style="position: relative; padding-right: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; right: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            المسح والتشخيص لداء السكري (Diabetes Mellitus) ومرحلة ما قبل السكري (Prediabetes).
        </li>
        <li style="position: relative; padding-right: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; right: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            متابعة كفاءة العلاج والسيطرة على سكر الدم لدى المرضى التشخيصيين.
        </li>
        <li style="position: relative; padding-right: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; right: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            تقييم استقلاب الكربوهيدرات لدى المصابين بمتلازمة الأيض، أو السمنة، أو سكري الحمل، أو التاريخ العائلي للسكري.
        </li>
        <li style="position: relative; padding-right: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; right: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            عنصر أساسي ضمن فحوصات التقييم الدوري الشامل والملف الفحصي قبل الجراحي.
        </li>
    </ul>

    <!-- Principle Box -->
    <div style="background-color: #fdfbf7; border: 1px solid #e7e2d8; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem;">
        <h3 style="margin-top: 0; color: #1e3a8a; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.75rem;">
            🧪 3. المبدأ الإنزيمي للتفاعل (طريقة GOD-POD)
        </h3>
        <p style="color: #334155; margin-bottom: 1rem;">
            يُأكسد الجلوكوز في العينة إنزيميًا بواسطة إنزيم <strong>Glucose Oxidase (GOD)</strong> ليتحول إلى حمض الجلوكونيك وفوق أكسيد الهيدروجين (H₂O₂). يتفاعل H₂O₂ بعد ذلك مع 4-aminoantipyrine والفينول بوجود إنزيم <strong>Peroxidase (POD)</strong> لإنتاج مركب الكينونيمين الملون (الوردي/الأحمر).
        </p>
        <div dir="ltr" style="background-color: #f3efe6; border-radius: 0.5rem; padding: 1rem; font-family: monospace; font-size: 0.95rem; color: #0f172a; text-align: center; font-weight: 700; border: 1px dashed #d6cebe; margin-bottom: 1rem; line-height: 1.6;">
            Glucose + O₂ + H₂O &nbsp;&xrightarrow{\text{GOD}}&nbsp; Gluconic Acid + H₂O₂<br>
            2 H₂O₂ + 4-AAP + Phenol &nbsp;&xrightarrow{\text{POD}}&nbsp; Quinoneimine Dye + 4 H₂O
        </div>
        <p style="color: #475569; font-size: 0.95rem; margin-bottom: 0;">
            تتناسب شدة امتصاص مركب الكينونيمين طرديًا مع تركيز الجلوكوز في العينة، وتُقاس طيفيًا عند طول موجي <strong>500 نانومتر (النطاق 492–550 نانومتر)</strong> مقابل محدد الكاشف (Blank).
        </p>
    </div>

    <!-- Equipment List -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🔬 4. المعدات والأجهزة المخبرية
    </h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 0.85rem; margin-bottom: 2rem;">
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">محلل كيميائي آلي أو نصف آلي (Cobas, Architect, BS)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">جهاز طرد مركزي (3000–3500 دورة/دقيقة)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">حمام مائي أو ماكينة حضن مضبوطة عند 37 درجة مئوية</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">ماصات دقيقة (Micropipettes 10µL &amp; 1000µL) ومعايرة</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">كوفيتات تفاعل زجاجية/بلاستيكية ومؤقت زمن</div>
    </div>

    <!-- Reagent Preparation -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🧪 5. تحضير الكواشف وثباتها
    </h2>
    <ul style="list-style: circle; padding-right: 1.25rem; margin-bottom: 2rem; color: #374151;">
        <li style="margin-bottom: 0.5rem;">معظم المحاليل التجارية تأتي ككواشف سائلة جاهزة للاستخدام المباشر (RTU).</li>
        <li style="margin-bottom: 0.5rem;">في حال الكواشف المجفدة، يُعاد التحلل بالدقة المطلوبة مع إتاحة 15–30 دقيقة في درجة حرارة الغرفة (15–25 °م) للوصول للتوازن.</li>
        <li style="margin-bottom: 0.5rem;">تظل المحاليل صالحة حتى تاريخ الانتهاء عند حفظها في درجة <strong>2–8 °م</strong> بعيدًا عن الضوء المباشر.</li>
    </ul>

    <!-- Sample Handling Table -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🩸 6. نوع العينة والاحتياطات قبل التحليلية
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: right; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700; width: 28%;">المعامل</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">التفاصيل والبروتوكول</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700;">نوع العينة المطلوب</td>
                    <td style="padding: 0.85rem 1.25rem;">بلازما وريدية (أنبوب فلورايد أوكسالات — غطاء رمادي) أو مصل الدم</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700;">شرط الصيام السريري</td>
                    <td style="padding: 0.85rem 1.25rem;">صيام تام لمدة 8 إلى 12 ساعة (يُسمح بشرب الماء فقط)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700;">تثبيط تحلل الجلوكوز (Glycolysis)</td>
                    <td style="padding: 0.85rem 1.25rem;">يُثبط الفلورايد إنزيم Enolase لمنع استهلاك الجلوكوز (فقدان 5–7% في الساعة في الدم الكامل غير المفصول)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700;">الثبات والحفظ</td>
                    <td style="padding: 0.85rem 1.25rem;">البلازما المفصولة ثابته لمدة 8 ساعات في (15–25 °م)، 72 ساعة في (2–8 °م)، أو 30 يومًا مجمّدة (-20 °م)</td>
                </tr>
                <tr>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700;">عوامل التداخل الشائعة</td>
                    <td style="padding: 0.85rem 1.25rem; color: #b91c1c;">انحلال الدم (Hemolysis)، فرط دهون الدم (Lipemia)، أو تأخير فصل العينة يعطي نتائج منخفضة خاطئة</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Complete 7-Step Procedure Table -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📋 7. خطوات الإجراء المخبري الكاملة (7 خطوات)
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: right; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700; width: 15%;">الخطوة</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">الإجراء والتنفيذ المخبري</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">الخطوة 1</td>
                    <td style="padding: 0.85rem 1.25rem;">التحقق من هوية المريض، وسم الأنابيب، ثم فصل العينة بالطرد المركزي عند 3000–3500 دورة/دقيقة لمدة 10 دقائق.</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">الخطوة 2</td>
                    <td style="padding: 0.85rem 1.25rem;">معايرة الجهاز بـ Calibrator وتشغيل عينات ضبط الجودة (Controls) بمستوييها الطبيعي والمرضي.</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">الخطوة 3</td>
                    <td style="padding: 0.85rem 1.25rem;">سحب 10 ميكرولتر (10 µL) من (الماء المقطر للـ Blank / المحلول القياسي Standard / عينة المريض) في كوفيتات التفاعل.</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">الخطوة 4</td>
                    <td style="padding: 0.85rem 1.25rem;">إضافة 1000 ميكرولتر (1.0 mL) من كاشف GOD-POD العامل إلى كل أنبوب مع الخلط بلطف.</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">الخطوة 5</td>
                    <td style="padding: 0.85rem 1.25rem;"><strong>الحضن (Incubate): لمدة 10–15 دقيقة في الحمام المائي عند 37 درجة مئوية</strong> أـو <strong>لمدة 20–30 دقيقة في درجة حرارة الغرفة (15–25 °م)</strong>.</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">الخطوة 6</td>
                    <td style="padding: 0.85rem 1.25rem;">تصفير جهاز القياس الضوئي بعينة Blank، ثم قياس الامتصاصية للـ Standard والعينات عند طول موجي 500 نانومتر.</td>
                </tr>
                <tr style="background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">الخطوة 7</td>
                    <td style="padding: 0.85rem 1.25rem;">حساب التركيز: تركيز الجلوكوز (mg/dL) = (امتصاصية العينة ÷ امتصاصية المحلول القياسي) × 100 mg/dL. والتحقق من الاستقامة (Linearity حتى 500 mg/dL).</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Result Interpretation Table -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📊 8. تفسير النتائج السريرية (ADA Criteria)
    </h2>
    <div style="overflow-x: auto; margin-bottom: 1.5rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: right; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">نطاق النتيجة</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">التفسير والتشخيص السريري</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #f0fdf4;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #15803d;" dir="ltr">&lt; 100 mg/dL (&lt; 5.6 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #166534;">مستوى سكر صائم طبيعي (Normal)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #fffbeb;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #b45309;" dir="ltr">100–125 mg/dL (5.6–6.9 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #92400e;">ضعف سكر الصائم (Prediabetes — مرحلة ما قبل السكري)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #fef2f2;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #b91c1c;" dir="ltr">&ge; 126 mg/dL (&ge; 7.0 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #991b1b;">تشخيص أولي بداء السكري (يتطلب التأكيد في يوم آخر)</td>
                </tr>
                <tr style="background-color: #eff6ff;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #1d4ed8;" dir="ltr">&lt; 70 mg/dL (&lt; 3.9 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #1e40af;">هبوط سكر الدم (Hypoglycemia — قيمة حرجة تتطلب تدخلاً عاجلاً)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Reference Ranges -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📐 9. المدى الطبيعي ووحدات القياس
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: right; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">النظام والنطاق الجغرافي</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">المدى الطبيعي (Normal Range)</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700;">وحدة mg/dL (السودان، الشرق الأوسط، أمريكا)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">70–99 mg/dL</td>
                </tr>
                <tr>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700;">وحدة mmol/L (النظام الدولي SI، بريطانيا، كندا)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">3.9–5.5 mmol/L</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Final Comment -->
    <div style="background-color: #faf8f5; border: 1px solid #e7e2d8; border-radius: 0.75rem; padding: 1.25rem 1.5rem; margin-bottom: 2rem;">
        <h3 style="margin-top: 0; color: #7c2d12; font-size: 1.15rem; font-weight: 700; margin-bottom: 0.5rem;">
            💡 10. التعليق السريري والقيود التشخيصية
        </h3>
        <p style="margin-bottom: 0; color: #44403c; font-size: 0.98rem;">
            على الرغم من أهمية سكر الصائم في المسح الأولي، إلا أن القراءة المفردة تتأثر بالإجهاد الحاد، التوتر النفسي، أو عدم التزام المريض بالصيام التام. للمتابعة والتقييم طويل الأمد، يُعتبر فحص <strong>السكر التراكمي (HbA1c)</strong> الخيار المتفوق لأنه يحدد متوسط السكر على مدى 2–3 أشهر بدون اشتراط الصيام.
        </p>
    </div>

</div>
HTML;

// -----------------------------------------------------------------------------
// 4. SOMALI CONTENT (FULL SCIENTIFIC TRANSLATION)
// -----------------------------------------------------------------------------
$content_so = <<<HTML
<div class="paper-post-body" style="font-family: system-ui, -apple-system, sans-serif; color: #1c1917; line-height: 1.8; font-size: 1.05rem;">
    
    <!-- Abstract Box -->
    <div style="background-color: #f7f4ee; border-left: 4px solid #0f766e; padding: 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
        <h3 style="margin-top: 0; color: #0f766e; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">
            📌 1. Hordhac Kooban &amp; Nuxurka Sayniska
        </h3>
        <p style="margin-bottom: 0; color: #44403c; font-size: 1rem;">
            Baaritaanka Fasting Blood Sugar (FBS) (baaritaanka sonkorta ee soonka) waa mid ka mid ah baaritaannada kiimikada kliniikada ee ugu muhiimsan shaybaarrada diagnostic-ga ah ee adduunka. Wuxuu cabbiraa heerka glucose-ka balasmaha dhiigga xididka ka dib soon dhererkiisu yahay 8 ilaa 12 saacadood. Baaritaankani waa qalabka koowaad ee baarista iyo la socodka cudurka sonkorta (Diabetes Mellitus) iyo xanuunada dheef-shiidka.
        </p>
    </div>

    <!-- Objectives -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🎯 2. Ujeedada Baaritaanka
    </h2>
    <ul style="list-style: none; padding-left: 0; margin-bottom: 1.75rem;">
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Baarista iyo ogaanshaha Cudurka Sonkorta (Diabetes Mellitus) iyo heerka kahor-sonkorta (Prediabetes).
        </li>
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            La socodka waxtarka daaweynta iyo koontaroolka sonkorta ee bukaannada hore loo ogaaday.
        </li>
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Qiimaynta dheef-shiidka glucose-ka bukaannada qaba Metabolic Syndrome, obesity (cayilka), ama taariikhda qoyska.
        </li>
        <li style="position: relative; padding-left: 1.75rem; margin-bottom: 0.65rem; color: #374151;">
            <span style="position: absolute; left: 0; top: 0; color: #0d9488; font-weight: bold;">✓</span>
            Qayb muhiim ah oo ka mid ah baaritaannada caadiga ah iyo diyaarinta qalliinka kahor.
        </li>
    </ul>

    <!-- Principle Box -->
    <div style="background-color: #fdfbf7; border: 1px solid #e7e2d8; border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 2rem;">
        <h3 style="margin-top: 0; color: #1e3a8a; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.75rem;">
            🧪 3. Mabda'a Enzyme-ka (GOD-POD Method)
        </h3>
        <p style="color: #334155; margin-bottom: 1rem;">
            Glucose-ka muunadda waxaa habka enzyme-ka ah ku oksiidsheeya <strong>Glucose Oxidase (GOD)</strong> si uu u sameeyo gluconic acid iyo hydrogen peroxide (H₂O₂). Hydrogen peroxide wuxuu la falgalaa 4-aminoantipyrine iyo phenol isagoo kaashanaya <strong>Peroxidase (POD)</strong> si uu u soo saaro midab pink/red quinoneimine ah.
        </p>
        <div style="background-color: #f3efe6; border-radius: 0.5rem; padding: 1rem; font-family: monospace; font-size: 0.95rem; color: #0f172a; text-align: center; font-weight: 700; border: 1px dashed #d6cebe; margin-bottom: 1rem; line-height: 1.6;">
            Glucose + O₂ + H₂O &nbsp;&xrightarrow{\text{GOD}}&nbsp; Gluconic Acid + H₂O₂<br>
            2 H₂O₂ + 4-AAP + Phenol &nbsp;&xrightarrow{\text{POD}}&nbsp; Quinoneimine Dye + 4 H₂O
        </div>
        <p style="color: #475569; font-size: 0.95rem; margin-bottom: 0;">
            Xoojinta midabka waa toos proportional heerka glucose-ka muunadda, waxaana lagu cabbiraa photometer ama analyzer wavelength <strong>500 nm (492–550 nm)</strong>.
        </p>
    </div>

    <!-- Equipment List -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🔬 4. Qalabka Shaybaarka
    </h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 0.85rem; margin-bottom: 2rem;">
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">Makiinada Automated / Semi-automated Chemistry Analyzer (Cobas, Architect, BS series)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">Makiinada Centrifuge (3000–3500 RPM muddo 10 daqiiqo)</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">Water bath / Incubator lagu hagaajiyay 37 &deg;C</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">Micropipettes (10 &micro;L &amp; 1000 &micro;L) iyo tips</div>
        <div style="background: #faf8f5; border: 1px solid #e5dfd3; padding: 0.85rem 1rem; border-radius: 0.5rem; font-weight: 600;">Cuvettes ama micro-cells iyo timer</div>
    </div>

    <!-- Reagent Preparation -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🧪 5. Diyaarinta Kiimikada &amp; Kaydinta
    </h2>
    <ul style="list-style: circle; padding-left: 1.25rem; margin-bottom: 2rem; color: #374151;">
        <li style="margin-bottom: 0.5rem;">Inta badan kiimikooyinka GOD-POD waxay yimaadaan iyagoo diyaar ah (Ready-to-use liquid).</li>
        <li style="margin-bottom: 0.5rem;">Haddii ay yihiin lyophilized (qalalan), ku mil buffer-ka la socda oo u daa 15–30 daqiiqo heerkulka qolka (15–25 &deg;C) kahor isticmaalka.</li>
        <li style="margin-bottom: 0.5rem;">Kiimikadu waxay dhowrsan tahay illaa taariikhda dhicitaanka marka lagu kaydiyo <strong>2–8 &deg;C</strong> iyadoo ka fog iftiinka.</li>
    </ul>

    <!-- Sample Handling Table -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        🩸 6. Nooca Muunadda &amp; Qodobada Kahor-baarista
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700; width: 28%;">Qodobka</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Faahfaahinta &amp; Borotokoolka</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">Nooca Muunadda</td>
                    <td style="padding: 0.85rem 1.25rem; color: #44403c;">Venous Plasma oo lagu shubay Sodium Fluoride / Potassium Oxalate tube (Grey top) ama Serum</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">Shuruudaha Soonka</td>
                    <td style="padding: 0.85rem 1.25rem; color: #44403c;">Soon adag oo 8–12 saacadood ah (biyo Kaliya waa la oggol yahay)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">Ka-hortagga Glycolysis</td>
                    <td style="padding: 0.85rem 1.25rem; color: #44403c;">Fluoride wuxuu joojiyaa enzyme-ka enolase si looga hortago burburka sonkorta (5–7% hoos u dhac ah saacaddii dhiigga aan la kala saarin)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">Kaydinta &amp; Xasilloonida</td>
                    <td style="padding: 0.85rem 1.25rem; color: #44403c;">Balasmaha la kala saaray waa xasilloon yahay 8 saacadood (15–25 &deg;C), 72 saacadood (2–8 &deg;C), ama 30 maalmood (-20 &deg;C)</td>
                </tr>
                <tr>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1c1917;">Carqaladayn (Interferences)</td>
                    <td style="padding: 0.85rem 1.25rem; color: #b91c1c;">Hemolysis (dhiig-bur), lipemia daran, ama dib-u-dhaca centrifuge-ka waxay keenaan natiijo hoose oo khaldan</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Complete 7-Step Procedure Table -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📋 7. Nidaamka Shaqada ee Dhameystiran (7 Tallaabo)
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700; width: 15%;">Tallaabada</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Ficilka &amp; Borotokoolka Shaqada</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Tallaabada 1</td>
                    <td style="padding: 0.85rem 1.25rem;">Hubi magaca bukaanka, calaamadee tuubbooyinka, ku centrifuge 3000–3500 RPM muddo 10 daqiiqo ah.</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Tallaabada 2</td>
                    <td style="padding: 0.85rem 1.25rem;">Ku Calibrate makiinada calibrator-ka rasmiga ah oo wad 2-level Quality Control (Normal Level 1 &amp; Pathological Level 2).</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Tallaabada 3</td>
                    <td style="padding: 0.85rem 1.25rem;">Shub 10 &micro;L oo Reagent Blank (biyo), Standard (100 mg/dL), iyo Muunadda Bukaanka kuwaas oo cuvettes u gooni ah lagu shubayo.</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Tallaabada 4</td>
                    <td style="padding: 0.85rem 1.25rem;">Ku dar 1000 &micro;L (1.0 mL) oo GOD-POD Working Reagent ah tuubbo kasta oo si tartiib ah isku qas.</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Tallaabada 5</td>
                    <td style="padding: 0.85rem 1.25rem;"><strong>Incubate (kululee): Ku hay 10–15 daqiiqo water bath heerkulkiisu yahay 37 &deg;C</strong> AMA <strong>20–30 daqiiqo heerkulka qolka (15–25 &deg;C)</strong>.</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Tallaabada 6</td>
                    <td style="padding: 0.85rem 1.25rem;">Makiinadda ama photometer-ka ka eeg Absorbance-ka Standard (A_std) iyo Muunadda (A_sample) Wavelength 500 nm iyadoo Blank-ka zero lagu sameeyay.</td>
                </tr>
                <tr style="background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">Tallaabada 7</td>
                    <td style="padding: 0.85rem 1.25rem;">Xisaabi heerka Glucose: Glucose (mg/dL) = (A_sample / A_std) &times; 100 mg/dL. Hubi Linearity (ilaa 500 mg/dL).</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Result Interpretation -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📊 8. Qiimaynta Natiijooyinka (ADA Guidelines)
    </h2>
    <div style="overflow-x: auto; margin-bottom: 1.5rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Heerka Natiijada</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Qiimaynta Kliniikada</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #f0fdf4;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #15803d;">&lt; 100 mg/dL (&lt; 5.6 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #166534;">Sonkorta Soonka ee Caadiga ah (Normal)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #fffbeb;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #b45309;">100–125 mg/dL (5.6–6.9 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #92400e;">Heerka Kahor-sonkorta (Prediabetes)</td>
                </tr>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #fef2f2;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #b91c1c;">&ge; 126 mg/dL (&ge; 7.0 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #991b1b;">Cudurka Sonkorta (bocsho 2 maalmood oo kala duwan)</td>
                </tr>
                <tr style="background-color: #eff6ff;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #1d4ed8;">&lt; 70 mg/dL (&lt; 3.9 mmol/L)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600; color: #1e40af;">Hypoglycemia (Sonkor hoose oo u baahan caawimaad degdeg ah)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Reference Ranges -->
    <h2 style="color: #1c1917; font-size: 1.4rem; font-weight: 800; border-bottom: 2px solid #e7e2d8; padding-bottom: 0.5rem; margin-top: 2rem; margin-bottom: 1rem;">
        📐 9. Heerarka Caadiga ah &amp; Seeraarka Cabbirka
    </h2>
    <div style="overflow-x: auto; margin-bottom: 2rem; border-radius: 0.75rem; border: 1px solid #e7e2d8;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #ffffff; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f3efe6; color: #1c1917; border-bottom: 2px solid #e7e2d8;">
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Nidaamka Cabbirka</th>
                    <th style="padding: 0.85rem 1.25rem; font-weight: 700;">Heerka Caadiga ah (Normal Range)</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f1f0ec; background-color: #faf9f6;">
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600;">mg/dL (Sudan, Mareykanka, Bariga Dhexe)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">70–99 mg/dL</td>
                </tr>
                <tr>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 600;">mmol/L (International SI Units, UK, Canada)</td>
                    <td style="padding: 0.85rem 1.25rem; font-weight: 700; color: #0f766e;">3.9–5.5 mmol/L</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Final Comment -->
    <div style="background-color: #faf8f5; border: 1px solid #e7e2d8; border-radius: 0.75rem; padding: 1.25rem 1.5rem; margin-bottom: 2rem;">
        <h3 style="margin-top: 0; color: #7c2d12; font-size: 1.15rem; font-weight: 700; margin-bottom: 0.5rem;">
            💡 10. Tixgelinta Kliniikada
        </h3>
        <p style="margin-bottom: 0; color: #44403c; font-size: 0.98rem;">
            Baaritaanka FBS waa mid lagama maarmaan ah, laakiin hal cabbir oo kaliya waxaa saamaynta ku yeelan kara walwalka, jimicsiga, ama soonka oo aan sax ahayn. La socodka muddada dheer, baaritaanka <strong>HbA1c (Glycated Hemoglobin)</strong> ayaa bixiya celceliska 2–3 bilood oo aan soon u baahnayn.
        </p>
    </div>

</div>
HTML;

// 5. Build post payload
$data = [
    'title_en' => 'Fasting Blood Sugar (FBS) — Standard Clinical Laboratory Procedure',
    'title_ar' => 'فحص سكر الصائم (FBS) — الإجراء المخبري القياسي والشامل',
    'title_so' => 'Baaritaanka Sonkorta ee Soonka (FBS) — Nidaamka Shaqada ee Shaybaarka',
    'slug' => 'fasting-blood-sugar-fbs-standard-procedure',
    'excerpt_en' => 'Scientifically reviewed clinical laboratory standard operating procedure for Fasting Blood Sugar (FBS) testing, including enzymatic GOD-POD reaction principle, specimen handling, complete 7-step procedure, and ADA diagnostic criteria.',
    'excerpt_ar' => 'الدليل المخبري القياسي المراجع علمياً لفحص سكر الدم الصائم (FBS)، يتضمن مبدأ التفاعل الإنزيمي GOD-POD، احتياطات ما قبل التحليل، خطوات العمل السبع الكاملة، وتفسير النتائج وفق معايير جمعية السكري الأمريكية.',
    'excerpt_so' => 'Borotokoolka shaybaarka ee baaritaanka sonkorta soonka (FBS), oo si saynis ah loo dib-u-eegey, oo sheegaya ujeedada, mabda\'a GOD-POD, diyaarinta muunadda, 7-da tallaabo ee shaqada, iyo qiimaynta kliniikada.',
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

echo "Post updated & saved with ID: " . $post->id . "\n";

// 7. Save template payload JSON for OpenClaw / Future automation
file_put_contents(__DIR__ . '/fbs_post_template.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Updated template payload saved to fbs_post_template.json\n";

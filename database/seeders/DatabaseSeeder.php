<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Payment;
use App\Models\StudyGroup;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Admin paroli faqat ADMIN_PASSWORD muhit o‘zgaruvchisidan olinadi.
        // Lokal muhitda o‘zgaruvchi bo‘lmasa, tasodifiy parol yaratiladi.
        $adminEmail = env('ADMIN_EMAIL', 'admin@olmacha.uz');
        $adminPassword = env('ADMIN_PASSWORD');
        $generatedAdminPassword = null;

        if (! is_string($adminPassword) || $adminPassword === '') {
            $adminPassword = null;

            if (app()->environment('local')) {
                $generatedAdminPassword = Str::random(20);
                $adminPassword = $generatedAdminPassword;
            }
        }

        if ($adminPassword !== null) {
            User::create([
                'name' => 'Dilshod Karimov',
                'email' => $adminEmail,
                'phone' => '+998 90 123 45 67',
                'role' => 'admin',
                'password' => Hash::make($adminPassword),
            ]);
        } else {
            $this->command?->warn('ADMIN_PASSWORD o‘rnatilmagan — admin hisobi yaratilmadi.');
        }

        // Demo talaba paroli ham tayyor (bashorat qilsa bo‘ladigan) bo‘lmasligi kerak.
        $studentPassword = env('DEMO_STUDENT_PASSWORD');
        if (! is_string($studentPassword) || $studentPassword === '') {
            $studentPassword = app()->environment('local') ? 'talaba123' : Str::random(40);
        }

        $demoStudent = User::create([
            'name' => 'Malika Yusupova',
            'email' => 'talaba@olmacha.uz',
            'phone' => '+998 91 234 56 78',
            'role' => 'student',
            'password' => Hash::make($studentPassword),
        ]);

        $courses = [
            [
                'title' => 'Ingliz tili — IELTS',
                'category' => 'Chet tillari',
                'level' => "Boshlang'ichdan Advanced gacha",
                'summary' => 'IELTS 6.5+ uchun yozish, gapirish, o‘qish va tinglash bo‘yicha intensiv kurs.',
                'description' => "Kurs noldan boshlab IELTS imtihoniga tayyorlaydi. Har bir darsda speaking va writing amaliyoti, har hafta mock test va individual fikr-mulohaza. Guruhlar 10 kishidan oshmaydi, shu sababli o‘qituvchi har bir talabaga vaqt ajratadi.",
                'syllabus' => "Grammar foundation va lug‘at boyligi\nSpeaking Part 1–3: javob strategiyalari\nWriting Task 1 va Task 2 shablonlari\nListening: section bo‘yicha mashqlar\nReading: skimming va scanning\nHar hafta to‘liq mock test",
                'duration_months' => 6,
                'lessons_per_week' => 3,
                'price' => 480000,
                'is_featured' => true,
            ],
            [
                'title' => 'Matematika — DTM',
                'category' => 'Aniq fanlar',
                'level' => '9–11 sinflar',
                'summary' => 'DTM va milliy sertifikat uchun matematikadan tizimli tayyorgarlik.',
                'description' => "Algebra, geometriya va matematik analiz asoslari bo‘yicha mustahkam poydevor. Har mavzu bo‘yicha amaliy mashg‘ulotlar, haftalik nazorat ishlari va DTM formatidagi testlar. Kichik guruhlarda individual yondashuv.",
                'syllabus' => "Sonlar va algebraik ifodalar\nTenglama va tengsizliklar\nFunksiya va grafiklar\nPlanimetriya\nStereometriya\nDTM formatidagi testlar tahlili",
                'duration_months' => 9,
                'lessons_per_week' => 3,
                'price' => 420000,
                'is_featured' => true,
            ],
            [
                'title' => 'Web dasturlash',
                'category' => 'IT',
                'level' => 'Noldan junior darajagacha',
                'summary' => 'HTML, CSS, JavaScript va Laravel bilan real loyihalar ustida ishlash.',
                'description' => "Amaliyotga qaratilgan kurs: har bir modul yakunida mini loyiha. Kurs oxirida portfolioga 3 ta real loyiha qo‘shiladi. Mentor bilan haftalik code review va karyera bo‘yicha maslahatlar.",
                'syllabus' => "HTML5 va semantik markup\nCSS: Flexbox, Grid, responsive dizayn\nJavaScript asoslari va DOM\nGit va GitHub\nPHP va Laravel asoslari\nMa‘lumotlar bazasi (MySQL)\nYakuniy loyiha va himoya",
                'duration_months' => 8,
                'lessons_per_week' => 3,
                'price' => 650000,
                'is_featured' => true,
            ],
            [
                'title' => 'Grafik dizayn',
                'category' => 'IT',
                'level' => "Boshlang'ich",
                'summary' => 'Figma, Photoshop va Illustrator bilan brending va SMM dizayni.',
                'description' => "Dizayn fikrlashdan tortib tayyor brending paketigacha. Har hafta amaliy topshiriq, mentor feedback va portfolioga mos ishlar. Kurs yakunida logotip va SMM to‘plamidan iborat portfolio.",
                'syllabus' => "Dizayn asoslari va kompozitsiya\nFigma: interfeys va prototip\nPhotoshop: retush va banner\nIllustrator: logotip va vektor\nBrending va brandbook\nPortfolio yig‘ish",
                'duration_months' => 5,
                'lessons_per_week' => 2,
                'price' => 550000,
                'is_featured' => false,
            ],
            [
                'title' => 'Rus tili',
                'category' => 'Chet tillari',
                'level' => "Boshlang'ich — o'rta",
                'summary' => 'Kundalik muloqot va ish yozishmalari uchun rus tili.',
                'description' => "Og‘zaki nutq va grammatikaga teng e‘tibor beriladi. Real hayotiy vaziyatlar, dialog mashqlari va tinglab tushunish. Guruhda 12 kishigacha, darslar haftada ikki marta.",
                'syllabus' => "Alifbo va talaffuz\nAsosiy grammatika\nKundalik muloqot mavzulari\nIsh yozishmalari\nTinglab tushunish\nYakuniy suhbat",
                'duration_months' => 6,
                'lessons_per_week' => 2,
                'price' => 350000,
                'is_featured' => false,
            ],
            [
                'title' => 'Kimyo va biologiya — DTM',
                'category' => 'Aniq fanlar',
                'level' => '9–11 sinflar',
                'summary' => 'Tibbiyot yo‘nalishiga kiruvchilar uchun kimyo-biologiya bloki.',
                'description' => "Kimyo va biologiya fanlarini birga olib boradigan yaxlit kurs. Laboratoriya mashg‘ulotlari, sxema va jadvallar bilan yodlash emas, tushunishga qaratilgan tayyorgarlik.",
                'syllabus' => "Kimyo asoslari va qonunlar\nOrganik kimyo\nHujayra va genetika\nOdam anatomiyasi\nO‘simlik va hayvonot dunyosi\nDTM testlari",
                'duration_months' => 9,
                'lessons_per_week' => 3,
                'price' => 430000,
                'is_featured' => false,
            ],
        ];

        foreach ($courses as $data) {
            Course::create($data + [
                'slug' => Course::makeSlug($data['title']),
                'is_active' => true,
            ]);
        }

        $teachers = [
            Teacher::create([
                'name' => 'Nilufar Ahmedova',
                'specialty' => 'Ingliz tili, IELTS 8.0',
                'experience_years' => 9,
                'bio' => "9 yildan ortiq tajriba, 400+ talaba IELTS 6.5+ natija olgan. Cambridge CELTA sertifikati sohibasi.",
                'phone' => '+998 90 111 22 33',
                'email' => 'nilufar@olmacha.uz',
                'is_active' => true,
            ]),
            Teacher::create([
                'name' => 'Sardor Odilov',
                'specialty' => 'Matematika, DTM',
                'experience_years' => 12,
                'bio' => "Respublika olimpiadasi sovrindori, 12 yillik o‘qituvchilik tajribasi. Matematikani hayotiy misollar bilan tushuntiradi.",
                'phone' => '+998 90 222 33 44',
                'email' => 'sardor@olmacha.uz',
                'is_active' => true,
            ]),
            Teacher::create([
                'name' => 'Jasur Toshmatov',
                'specialty' => 'Web dasturlash, Laravel',
                'experience_years' => 7,
                'bio' => "7 yillik backend dasturchi tajribasi. Bir nechta startup loyihalarida texnik yetakchi bo‘lgan.",
                'phone' => '+998 90 333 44 55',
                'email' => 'jasur@olmacha.uz',
                'is_active' => true,
            ]),
            Teacher::create([
                'name' => 'Zulfiya Rasulova',
                'specialty' => 'Grafik dizayn, Figma',
                'experience_years' => 5,
                'bio' => "Brending va SMM dizayni bo‘yicha mutaxassis, 100+ brend bilan ishlagan.",
                'phone' => '+998 90 444 55 66',
                'email' => 'zulfiya@olmacha.uz',
                'is_active' => true,
            ]),
            Teacher::create([
                'name' => 'Ozoda Karimova',
                'specialty' => 'Rus tili',
                'experience_years' => 11,
                'bio' => "11 yillik tajriba, rus tili bo‘yicha xalqaro daraja sertifikati (TORFL C1).",
                'phone' => '+998 90 555 66 77',
                'email' => 'ozoda@olmacha.uz',
                'is_active' => true,
            ]),
        ];

        $allCourses = Course::all();
        $groups = [
            ['course' => 0, 'teacher' => 0, 'name' => 'IELTS-INT-01', 'room' => '201-xona', 'schedule' => 'Du, Cho, Ju — 18:00', 'starts_at' => now()->subWeeks(6)->toDateString(), 'capacity' => 12],
            ['course' => 0, 'teacher' => 0, 'name' => 'IELTS-BEG-03', 'room' => '202-xona', 'schedule' => 'Se, Pa, Sha — 16:00', 'starts_at' => now()->addDays(9)->toDateString(), 'capacity' => 12],
            ['course' => 1, 'teacher' => 1, 'name' => 'MAT-DTM-02', 'room' => '105-xona', 'schedule' => 'Du, Cho, Ju — 15:00', 'starts_at' => now()->subWeeks(4)->toDateString(), 'capacity' => 14],
            ['course' => 2, 'teacher' => 2, 'name' => 'WEB-01', 'room' => 'IT-lab', 'schedule' => 'Se, Pa, Sha — 19:00', 'starts_at' => now()->addDays(4)->toDateString(), 'capacity' => 10],
            ['course' => 3, 'teacher' => 3, 'name' => 'DES-02', 'room' => '207-xona', 'schedule' => 'Se, Pa — 17:00', 'starts_at' => now()->addDays(14)->toDateString(), 'capacity' => 12],
            ['course' => 5, 'teacher' => 1, 'name' => 'BIO-KIM-01', 'room' => '106-xona', 'schedule' => 'Du, Cho, Ju — 14:00', 'starts_at' => now()->addDays(20)->toDateString(), 'capacity' => 16],
        ];

        $studyGroups = [];
        foreach ($groups as $data) {
            $studyGroups[] = StudyGroup::create([
                'course_id' => $allCourses[$data['course']]->id,
                'teacher_id' => $teachers[$data['teacher']]->id,
                'name' => $data['name'],
                'room' => $data['room'],
                'schedule' => $data['schedule'],
                'starts_at' => $data['starts_at'],
                'capacity' => $data['capacity'],
                'is_active' => true,
            ]);
        }

        $otherStudents = [
            ['Aziza Rahmonova', 'aziza@example.com', '+998 93 111 22 33'],
            ['Bekzod Ismoilov', 'bekzod@example.com', '+998 94 222 33 44'],
            ['Diyora Sobirova', 'diyora@example.com', '+998 95 333 44 55'],
            ['Eldor Nazarov', 'eldor@example.com', '+998 97 444 55 66'],
            ['Feruza Qodirova', 'feruza@example.com', '+998 88 555 66 77'],
            ['G‘ayrat Shodiyev', 'gayrat@example.com', '+998 99 666 77 88'],
        ];

        $students = [$demoStudent];
        foreach ($otherStudents as $index => $row) {
            $students[] = User::create([
                'name' => $row[0],
                'email' => $row[1],
                'phone' => $row[2],
                'role' => 'student',
                'password' => Hash::make($studentPassword),
            ]);
        }

        foreach ($students as $index => $student) {
            $targetGroups = [$studyGroups[0], $studyGroups[2]];
            if ($index === 2) {
                $targetGroups[] = $studyGroups[4];
            }

            foreach ($targetGroups as $group) {
                if ($group->name === 'DES-02' && $student->is($demoStudent)) {
                    continue;
                }

                Enrollment::create([
                    'user_id' => $student->id,
                    'study_group_id' => $group->id,
                    'status' => 'active',
                    'enrolled_at' => $group->starts_at,
                ]);
            }
        }

        foreach ($studyGroups as $group) {
            $titles = ['Kirish darsi', 'Asosiy mavzu', 'Amaliyot', 'Tahlil darsi', 'Mustahkamlash', 'Nazorat ishi'];
            for ($i = 0; $i < 6; $i++) {
                $lesson = Lesson::create([
                    'study_group_id' => $group->id,
                    'title' => $i === 0 ? 'Kirish darsi' : 'Dars '.($i + 1),
                    'topic' => $titles[$i] ?? 'Mavzu',
                    'starts_at' => now()->subWeeks(5 - $i)->setTime(18, 0),
                    'duration_minutes' => 90,
                ]);

                if ($group->id === $studyGroups[0]->id || $group->id === $studyGroups[2]->id) {
                    $lessonStudents = Enrollment::where('study_group_id', $group->id)->pluck('user_id');
                    foreach ($lessonStudents as $studentId) {
                        Attendance::create([
                            'lesson_id' => $lesson->id,
                            'user_id' => $studentId,
                            'status' => ($i === 3 && $studentId === $demoStudent->id) ? 'absent' : 'present',
                        ]);
                    }
                }
            }

            for ($i = 1; $i <= 4; $i++) {
                Lesson::create([
                    'study_group_id' => $group->id,
                    'title' => 'Dars',
                    'topic' => 'Yangi mavzu',
                    'starts_at' => now()->addWeeks($i - 1)->setTime(18, 0),
                    'duration_minutes' => 90,
                ]);
            }
        }

        $payments = [
            ['user' => $demoStudent, 'group' => $studyGroups[0], 'amount' => 480000, 'method' => 'card', 'paid_at' => now()->subMonths(2)],
            ['user' => $demoStudent, 'group' => $studyGroups[0], 'amount' => 480000, 'method' => 'card', 'paid_at' => now()->subMonth()],
            ['user' => $demoStudent, 'group' => $studyGroups[2], 'amount' => 420000, 'method' => 'cash', 'paid_at' => now()->subDays(12)],
            ['user' => $students[1], 'group' => $studyGroups[0], 'amount' => 480000, 'method' => 'cash', 'paid_at' => now()->subDays(5)],
            ['user' => $students[2], 'group' => $studyGroups[1], 'amount' => 480000, 'method' => 'transfer', 'paid_at' => now()->subDays(2)],
        ];

        foreach ($payments as $data) {
            Payment::create([
                'user_id' => $data['user']->id,
                'study_group_id' => $data['group']->id,
                'amount' => $data['amount'],
                'method' => $data['method'],
                'status' => 'paid',
                'paid_at' => $data['paid_at'],
                'note' => 'Oylik to‘lov',
            ]);
        }

        $applications = [
            ['Shahzoda Alimova', '+998 90 777 88 99', 'shahzoda@example.com', 0, 'IELTS kursiga yozilmoqchiman, kechki guruh bo‘lsa.', 'new'],
            ['Islom Rustamov', '+998 91 888 99 00', null, 2, 'Web dasturlash kursi haqida ma’lumot kerak.', 'contacted'],
            ['Madina Tursunova', '+998 93 999 00 11', 'madina@example.com', 1, 'Matematika kursida joy bormi?', 'enrolled'],
            ['Otabek Yo‘ldoshev', '+998 94 123 00 22', null, null, 'Grafik dizayn bo‘yicha maslahat kerak.', 'new'],
        ];

        foreach ($applications as $row) {
            Application::create([
                'name' => $row[0],
                'phone' => $row[1],
                'email' => $row[2],
                'course_id' => $row[3] === null ? null : $allCourses[$row[3]]->id,
                'message' => $row[4],
                'status' => $row[5],
            ]);
        }

        if ($adminPassword !== null) {
            $this->command?->info('Admin: '.$adminEmail);

            if ($generatedAdminPassword !== null) {
                $this->command?->warn('Lokal admin paroli: '.$generatedAdminPassword);
            }
        }

        if (app()->environment('local')) {
            $this->command?->info('Demo talaba: talaba@olmacha.uz / '.$studentPassword);
        }
    }
}

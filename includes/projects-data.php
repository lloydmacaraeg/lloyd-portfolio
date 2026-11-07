<?php
/**
 * Portfolio projects.
 *
 * To add a project, copy one block, give it a unique slug, and fill in the fields.
 * Add 'placeholder' => true only for sample entries (it shows a "Placeholder" badge).
 *
 * Fields
 *   slug        unique, URL-safe id (lowercase letters, numbers, hyphens) used by project.php?slug=...
 *   title       project name
 *   category    short label shown on the card (e.g. "Web App", "Networking")
 *   summary     one line shown on the card
 *   description array of paragraphs shown on the detail page
 *   role        your part in the project (shown under "My role" on the detail page)
 *   features    array of bullet points on the detail page
 *   stack       array of technologies
 *   image       file inside assets/images/
 *   repo        GitHub URL ('' to hide the button)
 *   demo        live demo URL ('' to hide the button)
 *   download    optional ['file' => 'assets/documents/x.ext', 'label' => 'Button text', 'note' => 'Small text under the buttons']
 *   video       optional ['file' => 'assets/videos/x.mp4', 'poster' => 'x.jpg'] preview player on the detail page (poster is a file in assets/images/)
 *   year        display year
 */
declare(strict_types=1);

return [
    [
        'slug'        => 'fitforge',
        'title'       => 'FitForge',
        'category'    => 'Web App',
        'summary'     => 'Team project: a fitness website for choosing, enrolling in and tracking training programs.',
        'description' => [
            'FitForge is a fitness website where visitors can browse training programs by level, from beginner to advanced, sign in, enroll in a program and track their progress.',
        ],
        'role'        => 'This was a team project and I was the UI designer.',
        'features'    => [
            'Training programs for different levels',
            'Filter programs by level',
            'Sign in and enroll in a program',
            'Progress tracker and account pages',
        ],
        'stack'       => ['HTML'],
        'image'       => 'fitforge.jpg',
        'repo'        => 'https://github.com/decendariojohnangelo9-coder/fitforge',
        'demo'        => 'https://fitforge-virid.vercel.app',
        'year'        => '2026',
    ],
    [
        'slug'        => 'barangay-hall-network',
        'title'       => 'Barangay Hall Network Infrastructure',
        'category'    => 'Networking',
        'summary'     => 'Team project: a complete network design for a barangay hall, built and simulated in Cisco Packet Tracer.',
        'description' => [
            'For my networking course, my team designed the network infrastructure of a barangay hall. The work covered the floor plan, VLSM IP addressing, device configuration and written documentation, and the finished network was built and simulated in Cisco Packet Tracer.',
        ],
        'role'        => 'This was a team project and the tasks were shared equally among the members. My part was the device configuration, floor plan, testing and topology.',
        'features'    => [
            'Floor plan of the barangay hall',
            'VLSM addressing plan',
            'Device configuration',
            'Network documentation',
            'Topology built and simulated in Cisco Packet Tracer',
        ],
        'stack'       => ['Cisco Packet Tracer', 'VLSM'],
        'image'       => 'barangay-network.jpg',
        'repo'        => '',
        'demo'        => '',
        'download'    => ['file' => 'assets/documents/barangay-hall-network.pkt', 'label' => 'Download Packet Tracer file', 'note' => 'The downloaded file opens in Cisco Packet Tracer.'],
        'year'        => '2026',
    ],
    [
        'slug'        => 'quiz-app',
        'title'       => 'Quiz App',
        'category'    => 'Mobile App',
        'summary'     => 'An Android multiple-choice quiz app on basic computer knowledge.',
        'description' => [
            'Quiz App is an Android app that tests basic computer knowledge. It opens with a Start screen, then shows one multiple-choice question at a time, such as what CPU stands for or what RAM is used for, and moves on with a Next button.',
            'Watch the preview video, or download the APK to try it on an Android phone.',
        ],
        'features'    => [
            'Start screen',
            'Multiple-choice questions on computer basics',
            'One question at a time with a Next button',
        ],
        'stack'       => ['Android'],
        'image'       => 'quiz-app-preview.jpg',
        'repo'        => '',
        'demo'        => '',
        'video'       => ['file' => 'assets/videos/quiz-app-preview.mp4', 'poster' => 'quiz-app-preview.jpg'],
        'download'    => ['file' => 'assets/documents/quiz-app.apk', 'label' => 'Download APK', 'note' => 'Android only. To install, your phone may ask you to allow installs from this source.'],
        'year'        => '',
    ],
];

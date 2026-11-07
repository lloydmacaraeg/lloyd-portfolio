<?php
/**
 * Site configuration.
 *
 * Everything marked PLACEHOLDER is sample content: replace it with your own.
 * Secrets (SMTP password etc.) must NEVER be written here. Put them in a
 * local .env file (git-ignored) or in your host's environment variables.
 */
declare(strict_types=1);

return [
    'site' => [
        'name'        => 'Lloyd Robin Macaraeg',
        'title'       => 'Aspiring Network Administrator',
        'intro'       => 'BSIT student from Valenzuela City learning to design, secure and maintain computer networks. I practice with Cisco Packet Tracer and write code in Java, C#, PHP and JavaScript.',
        'location'    => 'Valenzuela City, Philippines',
        'email'       => 'lloydmacaraeg21@gmail.com',
        'phone'       => '+639516900803',
        'description' => 'Portfolio of Lloyd Robin Macaraeg, BSIT student and aspiring network administrator in Valenzuela City, Philippines. Skills, seminars, projects and contact details.',
        'url'         => env('SITE_URL', ''),               // e.g. https://your-portfolio.onrender.com
        'resume_file' => 'assets/documents/resume.pdf',
    ],

    // Leave a url as '' to hide that link everywhere.
    'social' => [
        'github'   => ['label' => 'GitHub',   'icon' => 'fa-brands fa-github',   'url' => 'https://github.com/lloydmacaraeg'],
        'facebook' => ['label' => 'Facebook', 'icon' => 'fa-brands fa-facebook', 'url' => 'https://www.facebook.com/lloydrobin.macaraeg.7'],
        'linkedin' => ['label' => 'LinkedIn', 'icon' => 'fa-brands fa-linkedin', 'url' => ''],
    ],

    'about' => [
        'summary' => [
            'I am a third year BSIT student at Pamantasan ng Lungsod ng Valenzuela working toward a career as a network administrator. I like understanding how networks, systems and software fit together, and I practice by building simulated networks in Cisco Packet Tracer and writing code in Java, C#, PHP and JavaScript.',
            //'Outside the classroom I attend seminars on cybersecurity, open source, project management and developer tools to keep learning. I care about work that is reliable, secure and clearly organized.',
        ],
        'interests' => ['Computer networking', 'Cybersecurity', 'Network simulation with Cisco Packet Tracer', 'Internet of Things', 'Open source', 'Web development with PHP and JavaScript'],
        'objective' => 'To start my career in a network administrator or IT support role where I can help keep networks secure and reliable, learn from experienced engineers, and keep growing my networking and security skills.',
    ],

];

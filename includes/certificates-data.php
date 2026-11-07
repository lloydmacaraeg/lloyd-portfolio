<?php
/**
 * Certificates and seminars attended, shown as a grid of certificate frames.
 *
 *   title   name shown under the frame
 *   type    small line under the title (e.g. "Certificate of participation")
 *   image   file name inside assets/images/certificates/ ('' shows an empty frame)
 *
 * To add a certificate image: save it (JPG or PNG, landscape works best) in
 * assets/images/certificates/ and put its file name in 'image'.
 */
declare(strict_types=1);

return [
    ['title' => 'Cybersecurity Fundamentals', 'type' => 'Certificate of participation', 'image' => 'cyber.jpeg'],
    ['title' => 'Open Source Innovation: How Red Hat is Driving Real-World Technology', 'type' => 'Certificate of participation', 'image' => 'opensource.jpeg'],
    ['title' => 'Engineering the Speed of Thought: Maximizing Developer Efficiency with LLMs', 'type' => 'Certificate of participation', 'image' => 'engineering.jpeg'],
    ['title' => 'Mastering Project Management: Essential Skills for IT Success', 'type' => 'Certificate of participation', 'image' => 'masteringprojmanagement.jpeg'],
    ['title' => 'Getting Started with Cisco Packet Tracer', 'type' => 'Certificate of completion', 'image' => 'gettingstarted.jpg'],
    ['title' => 'Exploring Networking with Cisco Packet Tracer', 'type' => 'Certificate of completion', 'image' => 'exploringnetworking.jpg'],
    ['title' => 'Exploring Internet of Things with Cisco Packet Tracer', 'type' => 'Certificate of completion', 'image' => 'exploringiot.jpg'],
];

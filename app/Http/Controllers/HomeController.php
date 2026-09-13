<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Setting;

class HomeController extends Controller
{
    /**
     * Show the home/landing page - COMPLETELY HARDCODED
     */
    public function index()
    {
        // ===== HARDCODED SERVICES =====
        $services = [
            (object) [
                'icon' => 'fa-code',
                'name' => 'Web Development',
                'description' => 'Custom websites, web applications, and e-commerce platforms built with modern technologies.',
                'color' => '#4F46E5'
            ],
            (object) [
                'icon' => 'fa-laptop',
                'name' => 'Software Development',
                'description' => 'Custom software solutions, ERP systems, and business automation tools.',
                'color' => '#7C3AED'
            ],
            (object) [
                'icon' => 'fa-paint-brush',
                'name' => 'Graphics Design',
                'description' => 'Professional graphics, logos, banners, and visual identity for your brand.',
                'color' => '#06B6D4'
            ],
            (object) [
                'icon' => 'fa-print',
                'name' => 'Printing & Branding',
                'description' => 'High-quality printing services and complete branding solutions.',
                'color' => '#F59E0B'
            ],
            (object) [
                'icon' => 'fa-users-cog',
                'name' => 'IT Consultation',
                'description' => 'Expert IT advisory, infrastructure planning, and digital transformation consulting.',
                'color' => '#F43F5E'
            ],
            (object) [
                'icon' => 'fa-graduation-cap',
                'name' => 'LMS & Training',
                'description' => 'Learning Management Systems, CBT platforms, and online training solutions.',
                'color' => '#10B981'
            ],
        ];

        // ===== HARDCODED PROJECTS =====
        $projects = [
            (object) [
                'title' => 'EduCore',
                'category' => 'LMS',
                'icon' => 'fa-graduation-cap',
                'description' => 'Winning school management software for Climax Academy, Dumne.',
                'tags' => ['Laravel', 'Vue.js']
            ],
            (object) [
                'title' => 'SynapseNet',
                'category' => 'Web',
                'icon' => 'fa-link',
                'description' => 'Modern association management solution with React & Node.js.',
                'tags' => ['React', 'Node.js']
            ],
            (object) [
                'title' => 'NFT Marketplace',
                'category' => 'Blockchain',
                'icon' => 'fa-coins',
                'description' => 'Full dynamic NFT platform built on BlockDAG.',
                'tags' => ['Solidity', 'Web3']
            ],
            (object) [
                'title' => 'MGTECHS LMS',
                'category' => 'LMS',
                'icon' => 'fa-book',
                'description' => 'Complete LMS with CBT, certificates, and progress tracking.',
                'tags' => ['Laravel', 'Livewire']
            ],
            (object) [
                'title' => 'Client Portal',
                'category' => 'Web',
                'icon' => 'fa-users',
                'description' => 'Dedicated client portal for project tracking and collaboration.',
                'tags' => ['Laravel', 'Vue.js']
            ],
            (object) [
                'title' => 'Branding Package',
                'category' => 'Branding',
                'icon' => 'fa-palette',
                'description' => 'Complete branding package for a corporate client.',
                'tags' => ['Illustrator', 'Photoshop']
            ],
        ];

        // ===== HARDCODED TESTIMONIALS =====
        $testimonials = [
            (object) [
                'name' => 'Adeola Consulting',
                'role' => 'CEO',
                'text' => 'MGTECHS delivered an exceptional web solution that transformed our business operations. Professional, reliable, and innovative.',
                'avatar' => 'A'
            ],
            (object) [
                'name' => 'Climax Academy',
                'role' => 'Director',
                'text' => 'The EduCore LMS platform has revolutionized how we manage our school. The CBT feature is outstanding!',
                'avatar' => 'C'
            ],
            (object) [
                'name' => 'Eze Enterprises',
                'role' => 'Founder',
                'text' => 'The branding and web development services were top-notch. Highly recommended for any business.',
                'avatar' => 'E'
            ],
        ];

        // ===== HARDCODED BLOG POSTS =====
        $blogPosts = [
            (object) [
                'title' => 'Why Your Business Needs a Custom Website',
                'excerpt' => 'In today\'s digital age, having a professional website is no longer optional...',
                'image' => 'fa-newspaper',
                'date' => 'Dec 15, 2024'
            ],
            (object) [
                'title' => 'The Future of E-Learning in Nigeria',
                'excerpt' => 'With the rise of digital education, Nigerian schools are embracing online learning...',
                'image' => 'fa-graduation-cap',
                'date' => 'Dec 10, 2024'
            ],
            (object) [
                'title' => 'Top 5 Web Development Trends for 2025',
                'excerpt' => 'Stay ahead of the curve with these emerging web development trends...',
                'image' => 'fa-code',
                'date' => 'Dec 5, 2024'
            ],
        ];

        // ===== HARDCODED COURSES =====
        $courses = [
            (object) [
                'title' => 'Laravel Masterclass',
                'description' => 'Learn Laravel from basics to advanced with real-world projects.',
                'price' => 'Free',
                'image' => 'fa-laravel'
            ],
            (object) [
                'title' => 'Web Development Bootcamp',
                'description' => 'Complete web development course covering HTML, CSS, JavaScript, and React.',
                'price' => '₦50,000',
                'image' => 'fa-code'
            ],
            (object) [
                'title' => 'Blockchain Fundamentals',
                'description' => 'Understand blockchain technology, smart contracts, and Web3 development.',
                'price' => '₦75,000',
                'image' => 'fa-link'
            ],
            (object) [
                'title' => 'Graphics Design Pro',
                'description' => 'Master Adobe Photoshop, Illustrator, and professional design principles.',
                'price' => '₦45,000',
                'image' => 'fa-paint-brush'
            ],
        ];

        // ===== HARDCODED STATS =====
        $stats = [
            'projects' => 50,
            'clients' => 30,
            'students' => 100,
            'courses' => 12,
            'experience' => 4,
        ];

        $settings = $this->getSettings([
            'primary_color' => '#4F46E5',
            'secondary_color' => '#7C3AED',
            'accent_color' => '#06B6D4',
            'logo_text' => 'MG',
            'logo_highlight' => 'TECHS',
            'logo_badge' => 'Limited',
            'company_name' => 'MGTECHS Limited',
            'company_rc' => '1234567',
            'contact_email' => 'info@mgtechs.com.ng',
            'contact_phone' => '+234 816 159 5906',
            'contact_address' => 'Yola, Nigeria',
            'hero_title' => 'Transforming Ideas Into',
            'hero_highlight' => 'Digital Reality',
            'hero_description' => 'We create stunning web experiences, software solutions, and innovative digital products that drive results and transform businesses.',
            'hero_badge' => '🚀 MGTECHS Smart Innovations',
            'tech_stack' => 'PHP,Laravel,JavaScript,React,Vue.js,Web3,Solidity',
            'founder_name' => 'Maxwell Ephraim Halilu',
            'founder_title' => 'Founder & CEO',
            'founder_image' => 'images/avatar-placeholder.png',
            'footer_description' => 'Nigeria\'s trusted technology partner for innovative digital solutions.',
            'social_twitter' => '#',
            'social_linkedin' => '#',
            'social_github' => '#',
            'social_youtube' => '#',
            'meta_description' => 'MGTECHS Limited is a registered Nigerian technology company specializing in Web Development, Software, Graphics, Printing, Branding, and IT Consultation.',
            'meta_keywords' => 'MGTECHS, web development Nigeria, software development, graphics design, printing services, branding, IT consultation, LMS, CBT, e-learning Nigeria',
        ]);

        return view('home.index', compact('services', 'projects', 'testimonials', 'blogPosts', 'courses', 'stats', 'settings'));
    }

    /**
     * Show the about page
     */
    public function about()
    {
        $teamMembers = [
            [
                'name' => 'Maxwell Ephraim Halilu',
                'role' => 'Founder & CEO',
                'bio' => 'Full-stack developer with 4+ years experience in web development, blockchain, and software engineering.',
                'avatar' => asset('images/team/maxwell.jpg'),
                'social' => [
                    'twitter' => '#',
                    'linkedin' => '#',
                    'github' => '#',
                ]
            ],
        ];
        
        $stats = [
            'projects' => 50,
            'clients' => 30,
            'students' => 100,
            'experience' => 4,
        ];
        
        $settings = $this->getSettings();
        
        return view('home.about', compact('teamMembers', 'stats', 'settings'));
    }

    /**
     * Show the services page
     */
    public function services()
    {
        $services = $this->getServicesData();
        $settings = $this->getSettings();
        
        return view('home.services', compact('services', 'settings'));
    }

    /**
     * Show the portfolio page
     */
    public function portfolio()
    {
        $portfolios = $this->getPortfolioData();
        $categories = ['All', 'Web Development', 'Blockchain', 'LMS', 'Branding'];
        $settings = $this->getSettings();
        
        return view('home.portfolio', compact('portfolios', 'categories', 'settings'));
    }

    /**
     * Show the contact page
     */
    public function contact()
    {
        $contactInfo = [
            'address' => 'Yola, Nigeria',
            'phone' => '+234 816 159 5906',
            'email' => 'info@mgtechs.com.ng',
            'company_reg' => 'RC 1234567',
            'working_hours' => 'Mon - Fri: 9:00 AM - 6:00 PM',
        ];
        
        $settings = $this->getSettings();
        
        return view('home.contact', compact('contactInfo', 'settings'));
    }

    /**
     * Handle contact form submission
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Store in database or send email
        return response()->json([
            'success' => true,
            'message' => 'Thank you for your message! We will get back to you soon.'
        ]);
    }

    /**
     * Show the blog page - UPDATED WITH PAGINATION SUPPORT
     */
    public function blog()
    {
        $posts = $this->getBlogPostsData();
        $categories = ['Technology', 'Web Development', 'LMS', 'Business'];
        $recentPosts = array_slice($posts, 0, 5);
        $settings = $this->getSettings();
        
        // Convert to paginator if you want pagination
        // $posts = $this->paginateArray($posts, 6);
        
        return view('home.blog.index', compact('posts', 'categories', 'recentPosts', 'settings'));
    }

    /**
     * Show a single blog post
     */
    public function blogShow($slug)
    {
        $post = $this->getBlogPost($slug);
        $relatedPosts = [];
        $settings = $this->getSettings();
        
        return view('home.blog.show', compact('post', 'relatedPosts', 'settings'));
    }

    /**
     * Show courses page (public view)
     */
    public function courses()
    {
        $courses = $this->getCoursesData();
        $categories = ['All', 'Web Development', 'Blockchain', 'Design', 'LMS'];
        $settings = $this->getSettings();
        
        return view('home.courses.index', compact('courses', 'categories', 'settings'));
    }

    /**
     * Show a single course (public view)
     */
    public function courseShow($slug)
    {
        $course = $this->getCourse($slug);
        $isEnrolled = false;
        $settings = $this->getSettings();
        
        return view('home.courses.show', compact('course', 'isEnrolled', 'settings'));
    }

    // ===== HELPER METHODS FOR HARDCODED DATA =====

    private function getSettings(array $defaults = [])
    {
        $settings = array_merge([
            'site_name' => 'MGTECHS Limited',
            'tagline' => "Nigeria's Trusted Technology Partner",
            'primary_color' => '#4F46E5',
            'secondary_color' => '#7C3AED',
            'accent_color' => '#06B6D4',
            'background_color' => '#0F172A',
            'logo_text' => 'MG',
            'logo_highlight' => 'TECHS',
            'logo_badge' => 'Limited',
            'logo' => null,
            'favicon' => null,
            'company_name' => 'MGTECHS Limited',
            'company_rc' => '1234567',
            'contact_email' => 'info@mgtechs.com.ng',
            'contact_phone' => '+234 816 159 5906',
            'contact_address' => 'Yola, Nigeria',
            'footer_description' => 'Nigeria\'s trusted technology partner for innovative digital solutions.',
            'social_twitter' => '#',
            'social_linkedin' => '#',
            'social_github' => '#',
            'social_youtube' => '#',
            'meta_title' => 'MGTECHS Limited - Web Development & Digital Solutions',
            'meta_description' => 'MGTECHS Limited is a registered Nigerian technology company specializing in Web Development, Software, Graphics, Printing, Branding, and IT Consultation.',
            'meta_keywords' => 'MGTECHS, web development Nigeria, software development, graphics design, printing services, branding, IT consultation, LMS, CBT, e-learning Nigeria',
        ], $defaults);

        $stored = Setting::getAllSettings();
        $settings = array_merge($settings, $stored);

        return array_merge($settings, [
            'company_name' => $stored['site_name'] ?? $settings['company_name'],
            'company_rc' => $stored['company_reg'] ?? $settings['company_rc'],
            'contact_email' => $stored['mail_from_address'] ?? $settings['contact_email'],
            'social_twitter' => $stored['twitter_url'] ?? $settings['social_twitter'],
            'social_linkedin' => $stored['linkedin_url'] ?? $settings['social_linkedin'],
            'social_github' => $stored['github_url'] ?? $settings['social_github'],
            'social_youtube' => $stored['youtube_url'] ?? $settings['social_youtube'],
        ]);
    }

    private function getServicesData()
    {
        return [
            [
                'id' => 'web-development',
                'icon' => 'fa-code',
                'title' => 'Web Development',
                'description' => 'Custom websites, web applications, and e-commerce platforms built with modern technologies like Laravel, React, and Vue.js.',
                'features' => ['Custom Website Design', 'E-commerce Solutions', 'Web Applications', 'Content Management Systems', 'API Development', 'Maintenance & Support'],
                'color' => 'indigo'
            ],
            [
                'id' => 'software-development',
                'icon' => 'fa-laptop',
                'title' => 'Software Development',
                'description' => 'Custom software solutions, ERP systems, and business automation tools tailored to your specific needs.',
                'features' => ['Custom Software Development', 'ERP Systems', 'Business Automation', 'Desktop Applications', 'Mobile Applications', 'System Integration'],
                'color' => 'purple'
            ],
            [
                'id' => 'graphics-design',
                'icon' => 'fa-paint-brush',
                'title' => 'Graphics Design',
                'description' => 'Professional graphics, logos, banners, and visual identity for your brand that stands out.',
                'features' => ['Logo Design', 'Brand Identity', 'Social Media Graphics', 'Print Materials', 'Banner & Poster Design', 'Packaging Design'],
                'color' => 'cyan'
            ],
            [
                'id' => 'printing-branding',
                'icon' => 'fa-print',
                'title' => 'Printing & Branding',
                'description' => 'High-quality printing services and complete branding solutions for businesses of all sizes.',
                'features' => ['Business Cards', 'Brochures & Flyers', 'Banners & Billboards', 'Brand Guidelines', 'Corporate Stationery', 'Promotional Materials'],
                'color' => 'amber'
            ],
            [
                'id' => 'it-consulting',
                'icon' => 'fa-users-cog',
                'title' => 'IT Consultation',
                'description' => 'Expert IT advisory, infrastructure planning, and digital transformation consulting for your business.',
                'features' => ['IT Strategy', 'Infrastructure Planning', 'Digital Transformation', 'Technology Assessment', 'Project Management', 'Training & Support'],
                'color' => 'rose'
            ],
            [
                'id' => 'lms-training',
                'icon' => 'fa-graduation-cap',
                'title' => 'LMS & Training',
                'description' => 'Learning Management Systems, CBT platforms, and online training solutions for schools and organizations.',
                'features' => ['LMS Development', 'CBT Platforms', 'Online Courses', 'Student Management', 'Certificate Generation', 'Progress Tracking'],
                'color' => 'green'
            ],
        ];
    }

    private function getPortfolioData()
    {
        return [
            [
                'title' => 'EduCore',
                'category' => 'LMS',
                'icon' => 'fa-graduation-cap',
                'description' => 'Winning school management software for Climax Academy, Dumne.',
                'tags' => ['Laravel', 'Vue.js'],
                'featured' => true
            ],
            [
                'title' => 'SynapseNet',
                'category' => 'Web',
                'icon' => 'fa-link',
                'description' => 'Modern association management solution with React & Node.js.',
                'tags' => ['React', 'Node.js'],
                'featured' => true
            ],
            [
                'title' => 'NFT Marketplace',
                'category' => 'Blockchain',
                'icon' => 'fa-coins',
                'description' => 'Full dynamic NFT platform built on BlockDAG.',
                'tags' => ['Solidity', 'Web3'],
                'featured' => false
            ],
            [
                'title' => 'MGTECHS LMS',
                'category' => 'LMS',
                'icon' => 'fa-book',
                'description' => 'Complete LMS with CBT, certificates, and progress tracking.',
                'tags' => ['Laravel', 'Livewire'],
                'featured' => false
            ],
            [
                'title' => 'Client Portal',
                'category' => 'Web',
                'icon' => 'fa-users',
                'description' => 'Dedicated client portal for project tracking and collaboration.',
                'tags' => ['Laravel', 'Vue.js'],
                'featured' => false
            ],
            [
                'title' => 'Branding Package',
                'category' => 'Branding',
                'icon' => 'fa-palette',
                'description' => 'Complete branding package for a corporate client.',
                'tags' => ['Illustrator', 'Photoshop'],
                'featured' => false
            ],
        ];
    }

    private function getBlogPostsData()
    {
        return [
            (object) [
                'slug' => 'why-your-business-needs-a-custom-website',
                'title' => 'Why Your Business Needs a Custom Website',
                'excerpt' => 'In today\'s digital age, having a professional website is no longer optional...',
                'content' => 'Full content here...',
                'image' => 'fa-newspaper',
                'category' => 'Web Development',
                'author' => 'Maxwell Ephraim Halilu',
                'date' => 'Dec 15, 2024'
            ],
            (object) [
                'slug' => 'future-of-e-learning-in-nigeria',
                'title' => 'The Future of E-Learning in Nigeria',
                'excerpt' => 'With the rise of digital education, Nigerian schools are embracing online learning...',
                'content' => 'Full content here...',
                'image' => 'fa-graduation-cap',
                'category' => 'LMS',
                'author' => 'Maxwell Ephraim Halilu',
                'date' => 'Dec 10, 2024'
            ],
            (object) [
                'slug' => 'top-web-development-trends-2025',
                'title' => 'Top 5 Web Development Trends for 2025',
                'excerpt' => 'Stay ahead of the curve with these emerging web development trends...',
                'content' => 'Full content here...',
                'image' => 'fa-code',
                'category' => 'Technology',
                'author' => 'Maxwell Ephraim Halilu',
                'date' => 'Dec 5, 2024'
            ],
        ];
    }

    private function getBlogPost($slug)
    {
        $posts = $this->getBlogPostsData();
        foreach ($posts as $post) {
            if ($post->slug === $slug) {
                return $post;
            }
        }
        return $posts[0];
    }

    private function getCoursesData()
    {
        return [
            (object) [
                'slug' => 'laravel-masterclass',
                'title' => 'Laravel Masterclass',
                'description' => 'Learn Laravel from basics to advanced with real-world projects.',
                'price' => 'Free',
                'image' => 'fa-laravel',
                'instructor' => 'Maxwell Ephraim Halilu',
                'duration' => '8 Weeks'
            ],
            (object) [
                'slug' => 'web-development-bootcamp',
                'title' => 'Web Development Bootcamp',
                'description' => 'Complete web development course covering HTML, CSS, JavaScript, and React.',
                'price' => '₦50,000',
                'image' => 'fa-code',
                'instructor' => 'Maxwell Ephraim Halilu',
                'duration' => '12 Weeks'
            ],
            (object) [
                'slug' => 'blockchain-fundamentals',
                'title' => 'Blockchain Fundamentals',
                'description' => 'Understand blockchain technology, smart contracts, and Web3 development.',
                'price' => '₦75,000',
                'image' => 'fa-link',
                'instructor' => 'Maxwell Ephraim Halilu',
                'duration' => '6 Weeks'
            ],
            (object) [
                'slug' => 'graphics-design-pro',
                'title' => 'Graphics Design Pro',
                'description' => 'Master Adobe Photoshop, Illustrator, and professional design principles.',
                'price' => '₦45,000',
                'image' => 'fa-paint-brush',
                'instructor' => 'Maxwell Ephraim Halilu',
                'duration' => '8 Weeks'
            ],
        ];
    }

    private function getCourse($slug)
    {
        $courses = $this->getCoursesData();
        foreach ($courses as $course) {
            if ($course->slug === $slug) {
                return $course;
            }
        }
        return $courses[0];
    }

    /**
     * Helper method to paginate an array
     */
    private function paginateArray($items, $perPage = 6)
    {
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;
        
        $paginatedItems = array_slice($items, $offset, $perPage);
        
        return new LengthAwarePaginator(
            $paginatedItems,
            count($items),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}
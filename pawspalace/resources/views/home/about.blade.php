@extends('layouts.app')
@section('title', __('About Us'))
@section('subtitle', __('About Us'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="about-section" id="about-pawspalace">
                <h1 class="about-title">{{ __('About PawsPalace') }}</h1>
                <h4>{{ __('Our Story') }}</h4>
                <p>{{ __('PawsPalace was born out of the shared passion of a group of individuals, Alejandro, Angel, and Katherine, for animals. After years of working in different areas of the pet industry, they realized the need to create an online destination where animal lovers could find everything they need for their beloved furry companions.') }}
                </p>
                <h4>{{ __('Our Mission and Values') }}</h4>
                <p>{{ __('At PawsPalace, our mission is to provide pet owners with high-quality products that promote the happiness and well-being of their furry friends. We are committed to providing exceptional service, always maintaining integrity, transparency, and respect for all living beings.') }}
                </p>
                <h4>{{ __('Our Team') }}</h4>
                <p>{{ __('The PawsPalace team is made up of a passionate group of individuals who share an unwavering love for animals. From our founders to our customer service team, each member is dedicated to providing the best possible experience to our customers and their pets.') }}
                </p>
                <h4>{{ __('Our Commitment to the Community') }}</h4>
                <p>{{ __('At PawsPalace, we believe in giving back to the community that has given us so much. We collaborate with local animal shelters, donating a portion of our profits and organizing adoption events to help find loving homes for pets in need.') }}
                </p>
                <p>{{ __('PawsPalace has been honored with the Customer Service Excellence Award in the Pet Industry two consecutive years, recognizing our commitment to customer satisfaction and service quality.') }}
                </p>
                <p>{{ __("It's not just us who love PawsPalace! Our customers are delighted with our products and services. 'The quality of PawsPalace products is unbeatable!'") }}
                </p>
            </div>

            <div class="faq-section" id="faq">
                <h1 class="about-title">{{ __('Frequently Asked Questions') }}</h1>
                <div class="faq-item">
                    <h5>{{ __('What is the estimated delivery time?') }}</h5>
                    <p>{{ __('Delivery time varies depending on your location. Generally, orders are delivered within 3-5 business days.') }}
                    </p>
                </div>
                <div class="faq-item">
                    <h5>{{ __('What do I do if my order arrives damaged?') }}</h5>
                    <p>{{ __('If your order arrives damaged, please contact us immediately so we can resolve the issue as soon as possible.') }}
                    </p>
                </div>
                <div class="faq-item">
                    <h5>{{ __('Can I return a product?') }}</h5>
                    <p>{{ __('Yes, we accept returns within 30 days of receiving the product. Please review our return policy for more details.') }}
                    </p>
                </div>
                <div class="faq-item">
                    <h5>{{ __('Do you offer international shipping?') }}</h5>
                    <p>{{ __('Yes, we offer international shipping to most countries. Shipping costs and times may vary. Please check our shipping options during the checkout process.') }}
                    </p>
                </div>
                <div class="faq-item">
                    <h5>{{ __('Do you have a physical store?') }}</h5>
                    <p>{{ __('Currently, we have an exclusive location for visits from our furry friends. You can find a map with our location on the homepage.') }}
                    </p>
                </div>
                <div class="faq-item">
                    <h5>{{ __('How can I contact customer service?') }}</h5>
                    <p>{{ __('You can contact our customer service team by email at info@pawspalace.com or by calling +123456789.') }}
                    </p>
                </div>
            </div>

            <div class="privacy-policy-section" id="privacy-policy">
                <h1 class="about-title">{{ __('Privacy Policy') }}</h1>
                <p>{{ __('At PawsPalace, we take the privacy of our users very seriously. This privacy policy describes how we collect, use, and protect the personal information you provide to us.') }}
                </p>
                <h5>{{ __('Information We Collect') }}</h5>
                <p>{{ __('We collect personal information when you register on our online store, place an order, subscribe to our newsletter, or complete a form. The information we collect may include your name, email address, postal address, phone number, and payment details.') }}
                </p>
                <h5>{{ __('How We Use Your Information') }}</h5>
                <p>{{ __('We use the information we collect to process your orders, manage your account, send promotional emails, and improve our products and services. We may also use your information for marketing purposes, but only with your explicit consent.') }}
                </p>
                <h5>{{ __('Information Protection') }}</h5>
                <p>{{ __('We take security measures to protect your personal information against loss, misuse, or unauthorized access. We use SSL encryption to protect your data during transmission and maintain strict security procedures to protect your stored data.') }}
                </p>
                <h5>{{ __('Disclosure to Third Parties') }}</h5>
                <p>{{ __('We do not sell, trade, or transfer your personal information to third parties without your consent, except when necessary to comply with the law, enforce our website policies, or protect our rights, property, or safety.') }}
                </p>
                <h5>{{ __('Consent') }}</h5>
                <p>{{ __('By using our website, you agree to our privacy policy and give us your consent to collect, use, and protect your personal information in accordance with this policy.') }}
                </p>
                <h5>{{ __('Policy Updates') }}</h5>
                <p>{{ __('We reserve the right to update or change our privacy policy at any time. Any significant changes will be posted on this page. We recommend that you periodically review this page to stay informed about how we protect your information.') }}
                </p>
                <h5>{{ __('Contact') }}</h5>
                <p>{{ __('If you have any questions about our privacy policy, please contact us at info@pawspalace.com.') }}
                </p>
            </div>

            <div class="terms-conditions-section" id="terms-conditions">
                <h1 class="about-title">{{ __('Terms and Conditions') }}</h1>
                <p>{{ __('Please read these terms and conditions carefully before using our website.') }}</p>
                <h5>{{ __('Acceptance of Terms') }}</h5>
                <p>{{ __('By accessing and using this website, you agree to be bound by these terms and conditions and all applicable laws and regulations. If you do not agree to any of these terms, do not use our site.') }}
                </p>
                <h5>{{ __('Site Usage') }}</h5>
                <p>{{ __('The content of this website is for general information and personal use only. We reserve the right to modify or withdraw the site (or any part of it) temporarily or permanently with or without notice.') }}
                </p>
                <h5>{{ __('Intellectual Property') }}</h5>
                <p>{{ __('All intellectual property rights on this website, including but not limited to design, text, graphics, software, and all underlying source codes, are owned by us or our suppliers.') }}
                </p>
                <h5>{{ __('Third-Party Links') }}</h5>
                <p>{{ __('Our website may contain links to third-party websites. These links are provided solely for your convenience and do not imply endorsement or association with the linked site.') }}
                </p>
                <h5>{{ __('Limitation of Liability') }}</h5>
                <p>{{ __('We shall not be liable for any direct, indirect, incidental, special, consequential, or punitive damages arising from your use or access to this website.') }}
                </p>
                <h5>{{ __('Modifications') }}</h5>
                <p>{{ __('We reserve the right to modify these terms and conditions at any time. Modifications will be effective immediately upon posting on the website.') }}
                </p>
                <h5>{{ __('Applicable Law') }}</h5>
                <p>{{ __('These terms and conditions shall be governed and construed in accordance with the laws of the country in which we are located.') }}
                </p>
                <p>{{ __('If you have any questions about these terms and conditions, please contact us at info@pawspalace.com.') }}
                </p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="additional-info">
                <h3>{{ __('Additional Information') }}</h3>
                <ul>
                    <li><a href="#about-pawspalace">{{ __('About PawsPalace') }}</a></li>
                    <li><a href="#faq">{{ __('Frequently Asked Questions') }}</a></li>
                    <li><a href="#privacy-policy">{{ __('Privacy Policy') }}</a></li>
                    <li><a href="#terms-conditions">{{ __('Terms and Conditions') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
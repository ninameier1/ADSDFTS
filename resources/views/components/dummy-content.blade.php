<div {{ $attributes->merge(['class' => 'default-classes']) }} class="text-black dark:text-darktext">
    @if ($type === 'lorem')
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque urna at metus iaculis, vel egestas risus volutpat.</p>
        <p>Curabitur tincidunt erat eu diam sodales, nec fermentum urna iaculis. Integer ut augue id arcu placerat ultricies a eget nisi.</p>
    @elseif ($type === 'privacy')
        <p>We take your privacy seriously.</p>

        <p><strong>1. We’ll Never Give You Up</strong></p>
        <p>We will never share your personal data with third parties without your consent. Your information is safe with us.</p>

        <p><strong>2. We’ll Never Let You Down</strong></p>
        <p>Your privacy is our priority. We’ll never let you down by compromising your personal data or violating your trust.</p>

        <p><strong>3. We’ll Never Run Around and Desert You</strong></p>
        <p>We’ll always keep your data secure and confidential. We will never run around and desert your privacy.</p>

        <p><strong>4. We’ll Never Make You Cry</strong></p>
        <p>We understand how important your privacy is, and we will take every measure to ensure it’s protected. You’ll never experience any issues with your data security from us.</p>

        <p><strong>5. We’ll Never Tell a Lie and Hurt You</strong></p>
        <p>We promise to be transparent with you about how we handle your data. We will never lie or hurt you by mishandling your personal information.</p>

        <p><strong>6. Data Collection and Use</strong></p>
        <p>We collect only the necessary information to provide our services. This data will only be used for the purpose it was collected for, and we’ll never misuse it.</p>

        <p><strong>7. Changes to Privacy Policy</strong></p>
        <p>We may update this policy from time to time. However, we’ll never change our commitment to protecting your privacy.</p>
    @elseif ($type === 'terms')
        <p>You know the rules and so do I:</p>

        <p><strong>1. We’ll Never Give You Up</strong></p>
        <p>We will never give you up or let you down when it comes to your travel plans. Our buses are always ready to get you to your destination safely and on time.</p>

        <p><strong>2. We’ll Never Let You Down</strong></p>
        <p>Your satisfaction is our priority. We will always strive to deliver an excellent service and provide a smooth journey for you. If there’s an issue, we’ll resolve it quickly.</p>

        <p><strong>3. We’ll Never Run Around and Desert You</strong></p>
        <p>You can count on us for your trips. We will never cancel your ride without good reason, and we’ll always keep you informed of any changes or disruptions.</p>

        <p><strong>4. We’ll Never Make You Cry</strong></p>
        <p>Our customer service team is here to help you with any questions or issues you may have. We’ll always do our best to ensure that your experience is a positive one. If something goes wrong, we’ll make it right.</p>

        <p><strong>5. We’ll Never Tell a Lie and Hurt You</strong></p>
        <p>We believe in honesty and transparency. All of our pricing, schedules, and policies will be communicated clearly. We’ll never deceive you or mislead you about our services.</p>

        <p><strong>6. Your Responsibilities</strong></p>
        <p>While we promise to take care of you, we also ask that you take care of the bus and your fellow passengers. Please follow all safety instructions, respect the rules, and be considerate to others. We’re all in this together!</p>

        <p><strong>7. Changes to Our Service</strong></p>
        <p>We reserve the right to modify, suspend, or cancel services as needed. In the rare event that a change affects your booking, we will inform you promptly, and we’ll work with you to find a suitable alternative.</p>

        <p><strong>8. Booking and Payment</strong></p>
        <p>You agree to provide accurate information when booking your tickets, and you understand that payments for our services are final and non-refundable, unless a cancellation or change is initiated by us.</p>

        <p><strong>9. We’ll Never Break Our Promises</strong></p>
        <p>We will always fulfill our commitment to providing excellent and reliable transportation services. We will never break our promises to you, and we strive to keep our service at the highest standard.</p>

        <p><strong>10. Liability</strong></p>
        <p>We are not liable for delays or cancellations caused by weather, accidents, or any force majeure. However, we will always try to assist you and offer compensation where possible in line with our policies.</p>

        <p><strong>11. Amendments to These Terms</strong></p>
        <p>We may update or change these terms of service at any time. Any changes will be communicated to you, and we’ll always ensure you’re aware of any updates that affect your experience with us.</p>

        <p>By using our services, you agree to the above terms and conditions. Thank you for choosing us for your journey. We’ll never give you up on your travel needs!</p>
    @elseif ($type === 'faq')
        <p><strong>Q: What is your refund policy?</strong></p>
        <p>A: We will never give you up, and we will never let you down. Your satisfaction is guaranteed, or we’ll make it right!</p>

        <p><strong>Q: Can I cancel my subscription?</strong></p>
        <p>A: We’re never gonna say goodbye, so you can cancel anytime. But we hope you’ll stay forever!</p>

        <p><strong>Q: Do you offer customer support?</strong></p>
        <p>A: We’ll never run around and desert you! Our support team is here to assist you anytime you need help.</p>

        <p><strong>Q: What happens if I have an issue with my order?</strong></p>
        <p>A: We’re never gonna make you cry! We’ll fix any issues and ensure your order is perfect.</p>

        <p><strong>Q: Can I trust your service?</strong></p>
        <p>A: Yes, we’re never gonna tell a lie and hurt you. Our service is 100% trustworthy and reliable!</p>
    @elseif ($type === 'about')
        <p><strong>We Are Festibus!</strong></p>
        <p>Your Festival Starts With Us.</p>
        <br>
        <img src="{{ asset('images/rickroll.jpg') }}" alt="Rickroll" />
    @endif
</div>

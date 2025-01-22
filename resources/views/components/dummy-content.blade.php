<div class="p-4 bg-gray-100 text-gray-700">
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
        <p>Our commitment is to provide you with the best service possible. We will never give you up, no matter what.</p>

        <p><strong>2. We’ll Never Let You Down</strong></p>
        <p>Your satisfaction is our top priority. We promise to never let you down, and we will always be here for you when you need us.</p>

        <p><strong>3. We’ll Never Run Around and Desert You</strong></p>
        <p>We value your trust. You can rely on us to always stand by you, and we will never run around and desert you.</p>

        <p><strong>4. We’ll Never Make You Cry</strong></p>
        <p>We want to create a positive experience for you. Our service will never cause you pain or frustration. If you encounter any issues, we will resolve them swiftly.</p>

        <p><strong>5. We’ll Never Tell a Lie and Hurt You</strong></p>
        <p>Transparency is key. We’ll always be honest with you and ensure that your experience with us is trustworthy and secure.</p>

        <p><strong>6. Amendments to These Terms</strong></p>
        <p>We reserve the right to update or amend these terms. But rest assured, we will never break our promises to you. We’ll notify you of any significant changes.</p>
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
    @elseif ($type === 'rickroll')
        <img src="{{ asset('images/rickroll.jpg') }}" alt="Rickroll" />
    @endif
</div>

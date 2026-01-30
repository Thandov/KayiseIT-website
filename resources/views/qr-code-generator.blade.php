<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4" style="background-color: rgba(34, 197, 94, 0.1);">
                    <svg class="w-8 h-8" style="color:#22C55E;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Free QR Code Generator</h1>
                <p class="text-lg text-gray-600">Create custom QR codes instantly for URLs, text, contact information, and more</p>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                <!-- Type Selection -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">QR Code Type</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <button type="button" onclick="setQRType('url')" id="btn-url" class="qr-type-btn active px-4 py-2 rounded-lg border-2 font-medium text-sm transition-all" style="border-color: #22C55E; background-color: rgba(34, 197, 94, 0.1); color: #22C55E;">
                            URL
                        </button>
                        <button type="button" onclick="setQRType('text')" id="btn-text" class="qr-type-btn px-4 py-2 rounded-lg border-2 border-gray-300 font-medium text-sm transition-all hover:border-gray-400">
                            Text
                        </button>
                        <button type="button" onclick="setQRType('email')" id="btn-email" class="qr-type-btn px-4 py-2 rounded-lg border-2 border-gray-300 font-medium text-sm transition-all hover:border-gray-400">
                            Email
                        </button>
                        <button type="button" onclick="setQRType('phone')" id="btn-phone" class="qr-type-btn px-4 py-2 rounded-lg border-2 border-gray-300 font-medium text-sm transition-all hover:border-gray-400">
                            Phone
                        </button>
                    </div>
                </div>

                <!-- Input Forms -->
                <div id="form-url" class="qr-form">
                    <label for="url-input" class="block text-sm font-medium text-gray-700 mb-2">Website URL</label>
                    <input type="url" id="url-input" placeholder="https://example.com" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <div id="form-text" class="qr-form hidden">
                    <label for="text-input" class="block text-sm font-medium text-gray-700 mb-2">Text Content</label>
                    <textarea id="text-input" rows="4" placeholder="Enter any text you want to encode..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"></textarea>
                </div>

                <div id="form-email" class="qr-form hidden">
                    <div class="space-y-4">
                        <div>
                            <label for="email-input" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email-input" placeholder="example@email.com" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label for="subject-input" class="block text-sm font-medium text-gray-700 mb-2">Subject (Optional)</label>
                            <input type="text" id="subject-input" placeholder="Email subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label for="body-input" class="block text-sm font-medium text-gray-700 mb-2">Message (Optional)</label>
                            <textarea id="body-input" rows="3" placeholder="Email body text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"></textarea>
                        </div>
                    </div>
                </div>

                <div id="form-phone" class="qr-form hidden">
                    <label for="phone-input" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="tel" id="phone-input" placeholder="+1234567890" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Generate Button -->
                <div class="mt-6">
                    <button onclick="generateQR()" class="w-full px-6 py-3 rounded-lg text-white font-semibold text-lg transition-all hover:opacity-90 shadow-md" style="background-color: #22C55E;">
                        Generate QR Code
                    </button>
                </div>

                <!-- QR Code Display -->
                <div id="qr-result" class="mt-8 hidden">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 bg-gray-50">
                        <div class="flex flex-col md:flex-row items-center justify-center gap-6">
                            <div id="qrcode" class="bg-white p-4 rounded-lg shadow-sm"></div>
                            <div class="text-center md:text-left">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Your QR Code is Ready!</h3>
                                <p class="text-sm text-gray-600 mb-4">Right-click the QR code to save it as an image</p>
                                <button onclick="downloadQR()" class="px-4 py-2 rounded-lg text-white font-medium transition-all hover:opacity-90" style="background-color: #22C55E;">
                                    Download QR Code
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">How to Use</h2>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="text-center">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: rgba(34, 197, 94, 0.1);">
                            <span class="text-2xl font-bold" style="color:#22C55E;">1</span>
                        </div>
                        <h3 class="font-medium text-gray-900 mb-1">Choose Type</h3>
                        <p class="text-sm text-gray-600">Select URL, Text, Email, or Phone</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: rgba(34, 197, 94, 0.1);">
                            <span class="text-2xl font-bold" style="color:#22C55E;">2</span>
                        </div>
                        <h3 class="font-medium text-gray-900 mb-1">Enter Content</h3>
                        <p class="text-sm text-gray-600">Fill in the required information</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3" style="background-color: rgba(34, 197, 94, 0.1);">
                            <span class="text-2xl font-bold" style="color:#22C55E;">3</span>
                        </div>
                        <h3 class="font-medium text-gray-900 mb-1">Generate & Download</h3>
                        <p class="text-sm text-gray-600">Click generate and download your QR code</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- QR Code Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
        let currentQRType = 'url';
        let qrcodeInstance = null;

        function setQRType(type) {
            currentQRType = type;
            
            // Update button styles
            document.querySelectorAll('.qr-type-btn').forEach(btn => {
                btn.classList.remove('active');
                btn.style.borderColor = '#d1d5db';
                btn.style.backgroundColor = 'transparent';
                btn.style.color = '#374151';
            });
            
            const activeBtn = document.getElementById('btn-' + type);
            activeBtn.classList.add('active');
            activeBtn.style.borderColor = '#22C55E';
            activeBtn.style.backgroundColor = 'rgba(34, 197, 94, 0.1)';
            activeBtn.style.color = '#22C55E';
            
            // Show/hide forms
            document.querySelectorAll('.qr-form').forEach(form => {
                form.classList.add('hidden');
            });
            document.getElementById('form-' + type).classList.remove('hidden');
            
            // Hide previous QR code
            document.getElementById('qr-result').classList.add('hidden');
            if (qrcodeInstance) {
                document.getElementById('qrcode').innerHTML = '';
            }
        }

        function generateQR() {
            let content = '';
            
            switch(currentQRType) {
                case 'url':
                    content = document.getElementById('url-input').value.trim();
                    if (!content) {
                        alert('Please enter a URL');
                        return;
                    }
                    if (!content.startsWith('http://') && !content.startsWith('https://')) {
                        content = 'https://' + content;
                    }
                    break;
                    
                case 'text':
                    content = document.getElementById('text-input').value.trim();
                    if (!content) {
                        alert('Please enter some text');
                        return;
                    }
                    break;
                    
                case 'email':
                    const email = document.getElementById('email-input').value.trim();
                    if (!email) {
                        alert('Please enter an email address');
                        return;
                    }
                    const subject = document.getElementById('subject-input').value.trim();
                    const body = document.getElementById('body-input').value.trim();
                    content = 'mailto:' + email;
                    if (subject) {
                        content += '?subject=' + encodeURIComponent(subject);
                        if (body) {
                            content += '&body=' + encodeURIComponent(body);
                        } else if (body) {
                            content += '?body=' + encodeURIComponent(body);
                        }
                    }
                    break;
                    
                case 'phone':
                    content = document.getElementById('phone-input').value.trim();
                    if (!content) {
                        alert('Please enter a phone number');
                        return;
                    }
                    content = 'tel:' + content;
                    break;
            }
            
            // Clear previous QR code
            document.getElementById('qrcode').innerHTML = '';
            
            // Generate new QR code
            qrcodeInstance = new QRCode(document.getElementById('qrcode'), {
                text: content,
                width: 256,
                height: 256,
                colorDark: '#000000',
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.H
            });
            
            // Show result
            document.getElementById('qr-result').classList.remove('hidden');
            
            // Scroll to result
            document.getElementById('qr-result').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function downloadQR() {
            const qrImg = document.querySelector('#qrcode canvas');
            if (!qrImg) {
                alert('Please generate a QR code first');
                return;
            }
            
            // Create download link
            const link = document.createElement('a');
            link.download = 'qrcode-' + Date.now() + '.png';
            link.href = qrImg.toDataURL('image/png');
            link.click();
        }

        // Initialize with URL type
        setQRType('url');
    </script>
</x-app-layout>










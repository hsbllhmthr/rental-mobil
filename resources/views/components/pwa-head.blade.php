{{-- PWA Meta Tags --}}
<meta name="application-name" content="{{ config('app.name') }}">
<meta name="theme-color" content="#4f46e5">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">
<meta name="msapplication-TileColor" content="#4f46e5">
<meta name="msapplication-TileImage" content="/images/icons/icon-144x144.png">
<meta name="msapplication-navbutton-color" content="#4f46e5">

{{-- Manifest --}}
<link rel="manifest" href="/manifest.json">

{{-- Icons --}}
<link rel="icon" type="image/png" sizes="16x16" href="/images/icons/icon-16x16.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/icons/icon-32x32.png">
<link rel="apple-touch-icon" sizes="72x72" href="/images/icons/icon-72x72.png">
<link rel="apple-touch-icon" sizes="96x96" href="/images/icons/icon-96x96.png">
<link rel="apple-touch-icon" sizes="128x128" href="/images/icons/icon-128x128.png">
<link rel="apple-touch-icon" sizes="144x144" href="/images/icons/icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/images/icons/icon-152x152.png">
<link rel="apple-touch-icon" sizes="192x192" href="/images/icons/icon-192x192.png">
<link rel="apple-touch-icon" sizes="384x384" href="/images/icons/icon-384x384.png">
<link rel="apple-touch-icon" sizes="512x512" href="/images/icons/icon-512x512.png">

{{-- PWA Install and Service Worker Script --}}
<script>
  // Service Worker Registration
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
      navigator.serviceWorker.register('/sw.js', {
        scope: '/'
      })
      .then(function(registration) {
        console.log('ServiceWorker registration successful with scope: ', registration.scope);
        
        // Check for updates
        registration.addEventListener('updatefound', () => {
          const newWorker = registration.installing;
          newWorker.addEventListener('statechange', () => {
            if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
              // New content is available, refresh to update
              if (confirm('New version available! Refresh to update?')) {
                window.location.reload();
              }
            }
          });
        });
      })
      .catch(function(error) {
        console.log('ServiceWorker registration failed: ', error);
      });
    });
  }

  // PWA Install Prompt
  let deferredPrompt;
  let installButton = null;

  window.addEventListener('beforeinstallprompt', (e) => {
    console.log('beforeinstallprompt fired');
    // Prevent the mini-infobar from appearing on mobile
    e.preventDefault();
    // Stash the event so it can be triggered later
    deferredPrompt = e;
    
    // Show install button if it exists
    installButton = document.getElementById('pwa-install-btn');
    if (installButton) {
      installButton.style.display = 'block';
      installButton.addEventListener('click', installPWA);
    }
  });

  // Install PWA function
  function installPWA() {
    if (deferredPrompt) {
      // Show the install prompt
      deferredPrompt.prompt();
      
      // Wait for the user to respond to the prompt
      deferredPrompt.userChoice.then((choiceResult) => {
        if (choiceResult.outcome === 'accepted') {
          console.log('User accepted the install prompt');
        } else {
          console.log('User dismissed the install prompt');
        }
        deferredPrompt = null;
        
        // Hide install button
        if (installButton) {
          installButton.style.display = 'none';
        }
      });
    }
  }

  // Check if app is installed
  window.addEventListener('appinstalled', (evt) => {
    console.log('PWA was installed');
    // Hide install button
    if (installButton) {
      installButton.style.display = 'none';
    }
  });

  // Online/Offline status
  window.addEventListener('online', () => {
    console.log('App is online');
    // You can add UI feedback here
  });

  window.addEventListener('offline', () => {
    console.log('App is offline');
    // You can add UI feedback here
  });
</script>
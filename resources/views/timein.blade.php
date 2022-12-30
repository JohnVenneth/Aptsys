<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Aptsys</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>

<body>
  <section class="section">
    <div class="container">


    <div class="columns">
      <div class="column is-four-fifths">
        <div class="w-full bg-gray-100 p-6 rounded-lg">
          <h1 class="title text-center">
            @if ($type==0)
              Time IN for Attendance
            @else
              Time Out for Attendance
            @endif

          </h1>
        </div>

        <video autoplay id="video"></video>
<!--          <button class="button is-hidden" id="btnPlay">
          <span class="icon is-small">
            <i class="fas fa-play"></i>
          </span>
        </button>
        <button class="button" id="btnPause">
          <span class="icon is-small">
            <i class="fas fa-pause"></i>
          </span>
        </button>-->
        <button class="button is-success w-1/2" id="btnScreenshot" data-t={{ $type }}>
          <span class="icon is-small">
            <i class="fas fa-camera"></i>
          </span>
          <a class="text text-white">
            @if ($type==0)
              Capture and Time me IN
            @else
              Capture and Time me OUT
            @endif
          </a>
        </button>

        <button class="button" id="btnChangeCamera">
          <span class="icon">
            <i class="fas fa-sync-alt"></i>
          </span>
          <span>Switch camera</span>
        </button>
      </div>
      <div class="column is-hidden">
        <h2 class="title">Screenshots</h2>
        <div id="screenshots"></div>
      </div>
    </div>


    </div>
  </section>

  <footer class="footer">
    <div class="content has-text-left">
      <p class="text-xs">
        By <a href="https://www.webdevdrops.com/">Douglas Matoso</a> | <a
          href="https://github.com/doug2k1/javascript-camera">Source code</a>
      </p>
    </div>
  </footer>

  <canvas class="is-hidden" id="canvas"></canvas>
  <script src="{{ url('js/cam2.js') }}"></script>
</body>

</html>

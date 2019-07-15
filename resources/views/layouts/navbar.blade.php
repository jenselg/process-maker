<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="{{ url('/') }}">Process Maker</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav">
    <li class="nav-item {{ Request::is('processes') ? 'active' : '' }}">
      <a class="nav-link" href="{{ url('processes') }}">Manage Processes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="https://github.com/jenselg/process-maker">Github</a>
    </li>
  </ul>
</div>
</nav>

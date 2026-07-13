<?php
// You can add any PHP logic here for active menu items, user authentication, etc.
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// App-root-relative base path (works whether the site sits at /solidrow or a domain root,
// and no matter which sub-directory page includes this navbar).
$__appRoot = str_replace('\\', '/', dirname(__DIR__));
$__docRoot = str_replace('\\', '/', rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/'));
$__basePath = rtrim(str_replace($__docRoot, '', $__appRoot), '/');
$progressEndpoint = $__basePath . '/ajax/php/registration-progress.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <span class="brand-text">SOLIDROW GROUP OF COMPANIES</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Contact Info -->
                <div class="d-flex ms-auto align-items-center">
                    <a href="tel:+94112223344" class="nav-link text-white d-flex align-items-center me-3">
                        <i class="bi bi-telephone-fill me-1"></i> +94 77 930 1318
                    </a>
                    <a href="mailto:info@solidrow.lk" class="nav-link text-white d-flex align-items-center me-3">
                        <i class="bi bi-envelope-fill me-1"></i> info@solidrow.lk
                    </a>
                    <button type="button" class="btn btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#progressModal">
                        <i class="bi bi-search me-1"></i> Check Progress
                    </button>
                    <a href="jobs.php" class="btn btn-outline-light">
                        <i class="bi bi-briefcase me-1"></i> Careers
                    </a>
                </div>
            </ul>
        </div>
    </div>
</nav>

<!-- Registration Progress Modal -->
<div class="modal fade" id="progressModal" tabindex="-1" aria-labelledby="progressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content sr-progress-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="progressModalLabel">Check Your Registration Progress</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="progressSearchForm" class="d-flex gap-2 mb-2">
                    <input type="text" id="progressQuery" class="form-control form-control-lg"
                        placeholder="Passport No / Mobile No / NIC" autocomplete="off" required>
                    <button type="submit" id="progressSearchBtn" class="btn btn-lg sr-btn-search">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <div class="text-muted small mb-3">Enter your passport, mobile or NIC number to see your progress.</div>

                <div id="progressError" class="alert alert-danger d-none" role="alert"></div>

                <div id="progressResult" class="d-none">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                        <div>
                            <div class="sr-cand-name" id="progressName"></div>
                            <div class="sr-cand-reg" id="progressRegNo"></div>
                        </div>
                        <span class="sr-badge" id="progressBadge"></span>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between small text-muted mb-1">
                            <span>Overall progress</span>
                            <span id="progressPercentLabel">0%</span>
                        </div>
                        <div class="sr-track">
                            <div class="sr-fill" id="progressFill"></div>
                        </div>
                    </div>

                    <div class="sr-stepper" id="progressStepper"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .sr-progress-modal { border: none; border-radius: 16px; overflow: hidden; }
    .sr-progress-modal .modal-header { background: #011a42; color: #fff; border: none; }
    .sr-progress-modal .modal-title { font-weight: 700; }
    .sr-progress-modal .btn-close { filter: invert(1) grayscale(1) brightness(2); }
    .sr-btn-search { background: #f57c02; border: none; color: #fff; }
    .sr-btn-search:hover { background: #e06f00; color: #fff; }
    .sr-cand-name { font-size: 1.15rem; font-weight: 700; color: #011a42; }
    .sr-cand-reg { font-size: 0.8rem; color: #6b7280; }
    .sr-badge { font-size: 0.78rem; font-weight: 700; padding: 5px 12px; border-radius: 999px;
        background: #eef2f7; color: #4b5563; white-space: nowrap; }
    .sr-badge.done { background: #dcfce7; color: #15803d; }
    .sr-track { height: 10px; border-radius: 999px; background: #edf0f4; overflow: hidden; }
    .sr-fill { height: 100%; width: 0; border-radius: 999px; background: #22c55e; transition: width .5s ease; }
    .sr-stepper { display: flex; margin-top: 24px; }
    .sr-step { flex: 1; text-align: center; position: relative; }
    .sr-step .sr-line { position: absolute; top: 15px; left: 50%; width: 100%; height: 3px; background: #e5e7eb; z-index: 0; }
    .sr-step.done .sr-line { background: #22c55e; }
    .sr-node { position: relative; z-index: 1; width: 32px; height: 32px; border-radius: 50%; margin: 0 auto;
        display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700;
        background: #fff; border: 2px solid #d1d5db; color: #6b7280; }
    .sr-step.done .sr-node { background: #22c55e; border-color: #22c55e; color: #fff; }
    .sr-step-label { margin-top: 8px; font-size: 10.5px; line-height: 1.3; padding: 0 4px; color: #6b7280; }
    .sr-step.done .sr-step-label { color: #374151; font-weight: 600; }
</style>

<script>
    (function () {
        var form = document.getElementById('progressSearchForm');
        if (!form) return;
        var endpoint = <?php echo json_encode($progressEndpoint); ?>;
        var input = document.getElementById('progressQuery');
        var btn = document.getElementById('progressSearchBtn');
        var errBox = document.getElementById('progressError');
        var resultBox = document.getElementById('progressResult');

        function showError(msg) {
            resultBox.classList.add('d-none');
            errBox.textContent = msg;
            errBox.classList.remove('d-none');
        }

        function render(data) {
            errBox.classList.add('d-none');
            var sections = data.sections || [];
            var total = data.total_sections || sections.length || 6;
            var done = sections.filter(function (s) { return s.submitted; }).length;
            var percent = total ? Math.round((done / total) * 100) : 0;

            document.getElementById('progressName').textContent = data.full_name || '';
            document.getElementById('progressRegNo').textContent = data.registration_no || '';

            var badge = document.getElementById('progressBadge');
            if (data.is_completed) {
                badge.textContent = '✓ Completed';
                badge.classList.add('done');
            } else {
                badge.textContent = done + ' / ' + total + ' sections';
                badge.classList.remove('done');
            }

            document.getElementById('progressPercentLabel').textContent = percent + '%';
            document.getElementById('progressFill').style.width = percent + '%';

            var stepper = document.getElementById('progressStepper');
            stepper.innerHTML = '';
            sections.forEach(function (s, i) {
                var step = document.createElement('div');
                step.className = 'sr-step' + (s.submitted ? ' done' : '');
                var line = (i < sections.length - 1) ? '<div class="sr-line"></div>' : '';
                step.innerHTML =
                    line +
                    '<div class="sr-node">' + (s.submitted ? '✓' : s.section_no) + '</div>' +
                    '<div class="sr-step-label">' + s.title + '</div>';
                stepper.appendChild(step);
            });

            resultBox.classList.remove('d-none');
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var q = input.value.trim();
            if (!q) return;
            btn.disabled = true;
            errBox.classList.add('d-none');
            fetch(endpoint + '?q=' + encodeURIComponent(q), { headers: { 'Accept': 'application/json' } })
                .then(function (r) { return r.json().then(function (body) { return { ok: r.ok, body: body }; }); })
                .then(function (res) {
                    if (res.ok) render(res.body);
                    else showError((res.body && res.body.message) || 'No registration found for that number.');
                })
                .catch(function () { showError('Something went wrong. Please try again.'); })
                .finally(function () { btn.disabled = false; });
        });
    })();
</script>
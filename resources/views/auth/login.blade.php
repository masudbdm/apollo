@extends('layouts.app')
@push('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        :root {
            --bg-0: #07060a;
            --bg-1: #0d0710;
            --card: rgba(255, 255, 255, .08);
            --card-2: rgba(255, 255, 255, .12);
            --stroke: rgba(255, 255, 255, .14);
            --text: rgba(255, 255, 255, .92);
            --muted: rgba(255, 255, 255, .66);
            --danger: #ff2d55;
            --danger-2: #ff0033;
            --glow: rgba(255, 0, 64, .38);
            --shadow: 0 24px 80px rgba(0, 0, 0, .55);
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: "Poppins", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            margin: 0;
            color: var(--text);
            background: radial-gradient(1200px 700px at 70% -10%, rgba(255, 0, 64, .26), transparent 55%),
                radial-gradient(900px 600px at 10% 0%, rgba(255, 45, 85, .22), transparent 55%),
                linear-gradient(180deg, var(--bg-1), var(--bg-0));
            overflow-x: hidden;
        }

        /* animated "red shiny" light sweep */
        body::before,
        body::after {
            content: "";
            position: fixed;
            inset: -40vmax;
            pointer-events: none;
            z-index: 0;
        }

        body::before {
            background: conic-gradient(from 0deg at 50% 50%,
                    transparent,
                    rgba(255, 0, 64, .16),
                    transparent,
                    rgba(255, 45, 85, .12),
                    transparent);
            filter: blur(40px);
            opacity: .9;
            animation: apolloSpin 16s linear infinite;
        }

        body::after {
            background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, .06), transparent 55%);
            filter: blur(10px);
            opacity: .8;
            animation: apolloPulse 5.5s ease-in-out infinite;
        }

        @keyframes apolloSpin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes apolloPulse {
            0%,
            100% {
                transform: scale(1);
                opacity: .65;
            }

            50% {
                transform: scale(1.08);
                opacity: .95;
            }
        }

        .auth-shell {
            position: relative;
            z-index: 1;
            min-height: calc(100vh - 3rem);
            display: grid;
            place-items: center;
            padding: 40px 16px;
        }

        .auth-card {
            width: min(520px, 100%);
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(255, 255, 255, .10), rgba(255, 255, 255, .06));
            border: 1px solid rgba(255, 255, 255, .16);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            transform: translateY(6px);
            opacity: 0;
            animation: cardIn .7s cubic-bezier(.2, .8, .2, 1) forwards;
        }

        @keyframes cardIn {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* glaze highlight */
        .auth-card::before {
            content: "";
            position: absolute;
            inset: -2px;
            background: linear-gradient(115deg,
                    rgba(255, 255, 255, .20) 0%,
                    rgba(255, 255, 255, .06) 28%,
                    rgba(255, 0, 64, .12) 55%,
                    rgba(255, 255, 255, .04) 75%,
                    rgba(255, 255, 255, .14) 100%);
            opacity: .55;
            transform: translateX(-30%) translateY(-20%);
            filter: blur(0px);
            animation: glazeSweep 7.5s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes glazeSweep {
            0%,
            100% {
                transform: translateX(-35%) translateY(-22%) rotate(-6deg);
                opacity: .45;
            }

            50% {
                transform: translateX(18%) translateY(6%) rotate(6deg);
                opacity: .7;
            }
        }

        .auth-card__inner {
            position: relative;
            padding: 28px 28px 20px;
        }

        .brand {
            display: grid;
            justify-items: center;
            gap: 14px;
            padding-top: 6px;
        }

        .brand__logo {
            width: 88px;
            height: 88px;
            border-radius: 22px;
            object-fit: contain;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .14);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .35), 0 0 0 10px rgba(255, 0, 64, .06);
        }

        .title {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: .2px;
            text-align: center;
        }

        .subtitle {
            margin: 0;
            margin-top: -6px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
        }

        .form {
            margin-top: 22px;
            display: grid;
            gap: 14px;
        }

        .field {
            display: grid;
            gap: 8px;
            text-align: left;
        }

        .label {
            font-size: 12px;
            color: var(--muted);
            letter-spacing: .2px;
        }

        .control {
            position: relative;
        }

        .input {
            width: 100%;
            height: 46px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, .14);
            background: rgba(10, 8, 14, .38);
            color: var(--text);
            padding: 12px 14px;
            outline: none;
            transition: transform .15s ease, border-color .15s ease, box-shadow .15s ease, background-color .15s ease;
        }

        .input::placeholder {
            color: rgba(255, 255, 255, .45);
        }

        .input:focus {
            border-color: rgba(255, 0, 64, .55);
            box-shadow: 0 0 0 4px rgba(255, 0, 64, .18), 0 16px 40px rgba(0, 0, 0, .35);
            background: rgba(10, 8, 14, .52);
            transform: translateY(-1px);
        }

        .control.has-toggle .input {
            padding-right: 52px;
        }

        .toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, .12);
            background: rgba(255, 255, 255, .06);
            color: rgba(255, 255, 255, .85);
            display: grid;
            place-items: center;
            cursor: pointer;
            transition: background-color .15s ease, transform .15s ease, border-color .15s ease;
        }

        .toggle:hover {
            background: rgba(255, 255, 255, .10);
            border-color: rgba(255, 255, 255, .18);
        }

        .toggle:active {
            transform: translateY(-50%) scale(.98);
        }

        .toggle svg {
            width: 18px;
            height: 18px;
        }

        .invalid-feedback {
            display: block;
            margin-top: 6px;
            color: rgba(255, 120, 140, .95);
            font-size: 12px;
        }

        .actions {
            margin-top: 6px;
            display: grid;
            gap: 10px;
        }

        .btn-primary {
            height: 46px;
            width: 100%;
            border: none;
            border-radius: 14px;
            color: #fff;
            font-weight: 600;
            letter-spacing: .4px;
            background: linear-gradient(90deg, var(--danger-2), var(--danger));
            box-shadow: 0 14px 44px rgba(255, 0, 64, .22), 0 0 0 1px rgba(255, 0, 64, .14);
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform .15s ease, box-shadow .15s ease, filter .15s ease;
        }

        .btn-primary::before {
            content: "";
            position: absolute;
            inset: -2px;
            background: linear-gradient(120deg, transparent 0%, rgba(255, 255, 255, .35) 35%, transparent 70%);
            transform: translateX(-120%) skewX(-18deg);
            animation: shine 2.8s ease-in-out infinite;
            opacity: .75;
            pointer-events: none;
        }

        @keyframes shine {
            0%,
            55% {
                transform: translateX(-120%) skewX(-18deg);
            }

            100% {
                transform: translateX(120%) skewX(-18deg);
            }
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 56px rgba(255, 0, 64, .30), 0 0 0 1px rgba(255, 0, 64, .18);
            filter: saturate(1.04);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .footer {
            position: relative;
            padding: 14px 28px 22px;
            border-top: 1px solid rgba(255, 255, 255, .10);
            background: rgba(0, 0, 0, .10);
            text-align: center;
        }

        .link {
            color: rgba(255, 255, 255, .82);
            text-decoration: none;
            font-size: 13px;
            position: relative;
        }

        .link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 0, 64, .85), transparent);
            transform: scaleX(.28);
            transform-origin: center;
            opacity: .6;
            transition: transform .15s ease, opacity .15s ease;
        }

        .link:hover::after {
            transform: scaleX(1);
            opacity: 1;
        }

        @media (prefers-reduced-motion: reduce) {
            body::before,
            body::after,
            .auth-card,
            .auth-card::before,
            .btn-primary::before {
                animation: none !important;
            }
        }
    </style>
@endpush

@section('content')
    <div class="auth-shell">
        <div class="auth-card">
            <div class="auth-card__inner">
                <div class="brand">
                    <img class="brand__logo" src="{{ asset('storage/ws/'.$ws->logo) }}" alt="Logo" />
                    <h1 class="title">{{ __('Login') }}</h1>
                    <p class="subtitle">Welcome back. Sign in to continue.</p>
                </div>

                <form class="form" method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    <div class="field">
                        <div class="label">Email</div>
                        <div class="control">
                            <input type="email" id="email" class="input @error('email') is-invalid @enderror" name="email"
                                placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="email"
                                inputmode="email">
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field">
                        <div class="label">Password</div>
                        <div class="control has-toggle">
                            <input type="password" id="password" class="input @error('password') is-invalid @enderror"
                                name="password" required placeholder="••••••••" autocomplete="current-password">
                            <button type="button" class="toggle" id="passwordToggle" aria-label="Show password"
                                aria-pressed="false">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M2.2 12s3.6-7 9.8-7 9.8 7 9.8 7-3.6 7-9.8 7S2.2 12 2.2 12Z"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M12 15.2a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4Z"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-check d-none">
                        <input class="form" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : 'checked' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="actions">
                        <button type="submit" class="btn-primary">Log in</button>
                    </div>
                </form>
            </div>

            <div class="footer">
                <a class="link" href="{{ route('password.request') }}">Forgot Password?</a>
            </div>
        </div>
    </div>

    <script>
        (function () {
            var input = document.getElementById('password');
            var btn = document.getElementById('passwordToggle');
            if (!input || !btn) return;

            function setState(isVisible) {
                input.type = isVisible ? 'text' : 'password';
                btn.setAttribute('aria-pressed', String(isVisible));
                btn.setAttribute('aria-label', isVisible ? 'Hide password' : 'Show password');
            }

            btn.addEventListener('click', function () {
                setState(input.type === 'password');
            });
        })();
    </script>
@endsection

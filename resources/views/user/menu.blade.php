<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu | Japanify</title>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/motion-tailwind/motion-tailwind.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.ayroui.com/1.0/css/bootstrap.min.css" />
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.ayroui.com/1.0/css/starter.css" />
    <style type="text/css">
        .features-style-one .primary-btn-outline {
            border-color: var(--primary);
            color: var(--primary);
        }

        .features-style-one .active.primary-btn-outline,
        .features-style-one .primary-btn-outline:hover,
        .features-style-one .primary-btn-outline:focus {
            background: var(--primary-dark);
            color: var(--white);
        }

        .features-style-one .deactive.primary-btn-outline {
            color: var(--dark-3);
            border-color: var(--gray-4);
            pointer-events: none;
        }

        .features-one {
            background-color: var(--light-2);
            padding-top: 120px;
            padding-bottom: 120px;
        }

        .features-one .section-title {
            padding-bottom: 10px;
        }

        .features-one .title {
            font-size: 44px;
            font-weight: 600;
            color: var(--black);
            line-height: 55px;
        }

        @media (max-width: 767px) {
            .features-one .title {
                font-size: 30px;
                line-height: 35px;
            }
        }

        .features-one .text {
            font-size: 16px;
            line-height: 24px;
            color: var(--dark-3);
            margin-top: 24px;
        }

        .features-style-one {
            background-color: var(--white);
            padding: 40px 20px;
            margin-top: 40px;
            box-shadow: var(--shadow-2);
            border-radius: 4px;
            transition: all 0.3s;
        }

        .features-style-one:hover {
            box-shadow: var(--shadow-4);
        }

        .features-style-one .features-icon {
            position: relative;
            display: inline-block;
            z-index: 1;
            height: 100px;
            width: 100px;
            line-height: 100px;
            text-align: center;
            font-size: 40px;
            color: var(--primary);
            border: 2px solid rgba(187, 187, 187, 0.192);
            border-radius: 50%;
            transition: all 0.3s ease-out 0s;
        }

        @media (max-width: 767px) {
            .features-style-one .features-icon {
                height: 70px;
                width: 70px;
                line-height: 70px;
                font-size: 35px;
            }
        }

        .features-style-one:hover .features-icon {
            border-color: transparent;
            color: var(--white);
            background-color: var(--primary);
        }

        .features-style-one .features-content {
            margin-top: 24px;
        }

        .features-style-one .features-title {
            font-size: 26px;
            line-height: 35px;
            font-weight: 600;
            color: var(--black);
            transition: all 0.3s ease-out 0s;
        }

        @media only screen and (min-width: 992px) and (max-width: 1199px),
        (max-width: 767px) {
            .features-style-one .features-title {
                font-size: 22px;
            }
        }

        .features-style-one .text {
            color: var(--dark-3);
            margin-top: 16px;
        }

        .features-style-one .features-btn {
            margin-top: 32px;
        }
    </style>
</head>

<body>
    <section class="features-area features-one">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h3 class="title">Menu Test</h3>
                    </div>
                </div>
            </div>

            @foreach ($menuTests as $menuTest)
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-7 col-sm-9">
                        <div class="features-style-one text-center">
                            <div class="features-icon">
                                {{-- <i class="lni lni-compass"></i> --}}
                                {{ $menuTest->name }}
                            </div>
                            <div class="features-content">
                                {{-- <h4 class="features-title">Graphics Design</h4>
                            <p class="text">
                                Short description for the ones who look for something new.
                                Awesome!
                            </p> --}}
                                <div class="features-btn rounded-buttons">
                                    <a class="btn primary-btn-outline rounded-full" href="{{ route('user.menu.show', ['menu_id' => $menuTest->id])  }}">
                                        Continue
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <script src="https://cdn.ayroui.com/1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

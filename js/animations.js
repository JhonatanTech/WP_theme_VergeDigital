/**
 * Animações GSAP do tema Vergê Digital.
 *
 * Escopo: home (front-page.php) + elementos globais (header.php/footer.php).
 * Todas as demais páginas (single, page, category, author, busca, 404)
 * continuam usando só o animate.css que já existia.
 *
 * Guardas de segurança:
 * - Se o GSAP não carregar (CDN fora do ar), o script aborta cedo e o site
 *   continua funcionando normalmente, só sem as animações.
 * - prefers-reduced-motion desliga parallax, tilt e SplitText — mantém
 *   apenas fades curtos e simples.
 * - gsap.matchMedia() com o mesmo breakpoint de $breakpoint-mobile (770px)
 *   desliga tilt/hover-pop no mobile.
 */
(function () {
    'use strict';

    if (typeof gsap === 'undefined') {
        return;
    }

    gsap.registerPlugin(ScrollTrigger, SplitText);

    var DESKTOP_BREAKPOINT = '(min-width: 771px)';
    var MOBILE_BREAKPOINT = '(max-width: 770px)';
    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function ready(fn) {
        if (document.readyState !== 'loading') {
            fn();
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    }

    // Uma transition CSS no "transform" do próprio elemento briga com o
    // GSAP escrevendo a matriz a cada frame — na prática, trava a animação
    // no valor inicial e ela nunca chega no estado final (confirmado nos
    // testes: some/aparece bugado sem isso). Antes de animar x/y/scale/
    // rotate/rotateX/rotateY de um elemento, chama isso pra tirar só o
    // "transform" da lista de propriedades transicionadas — o resto (cor,
    // sombra etc.) continua transicionando normalmente. `restore()` devolve
    // a transition original (chame depois que a animação GSAP terminar; se
    // o elemento anima pra sempre — tipo um loop infinito — não precisa
    // chamar restore, o correto ali é deixar excluído mesmo).
    function excludeTransformTransition(el) {
        var current = window.getComputedStyle(el).transitionProperty;
        var kept = current.split(',').map(function (p) { return p.trim(); }).filter(function (p) {
            // O autoprefixer gera "transform, -webkit-transform" — os dois
            // precisam sair, senão o prefixado sozinho já briga com o GSAP.
            return p && !/(^|-)transform$/.test(p) && p !== 'all' && p !== 'none';
        });
        el.style.transitionProperty = kept.length ? kept.join(', ') : 'none';
        return function restore() {
            el.style.transitionProperty = '';
        };
    }

    // ---------------------------------------------------------------------
    // Header / menu mobile
    // ---------------------------------------------------------------------
    function initHeader() {
        var nav = document.querySelector('header nav');
        if (!nav) {
            return;
        }

        gsap.from(nav, {
            yPercent: -140,
            opacity: 0,
            duration: 1,
            ease: 'power3.out',
            delay: 0.1
        });

        // Compacta um pouco a pill ao rolar a página.
        ScrollTrigger.create({
            start: 'top -80',
            onEnter: function () {
                gsap.to(nav, { scale: 0.96, duration: 0.35, ease: 'power2.out' });
            },
            onLeaveBack: function () {
                gsap.to(nav, { scale: 1, duration: 0.35, ease: 'power2.out' });
            }
        });

        var logoLink = nav.querySelector('.logo-link');
        if (logoLink && !prefersReducedMotion) {
            // Só em telas com mouse de verdade: no mobile a logo já fica
            // centralizada via CSS transform (translate -50%,-50%), e o
            // GSAP escrevendo "rotate" no mesmo transform bagunçaria essa
            // centralização.
            gsap.matchMedia().add(DESKTOP_BREAKPOINT + ' and (pointer: fine)', function () {
                function onEnter() {
                    gsap.to(logoLink, { rotate: 360, duration: 0.6, ease: 'back.out(1.7)' });
                }
                function onLeave() {
                    gsap.set(logoLink, { rotate: 0, delay: 0.6 });
                }
                logoLink.addEventListener('mouseenter', onEnter);
                logoLink.addEventListener('mouseleave', onLeave);
                return function () {
                    logoLink.removeEventListener('mouseenter', onEnter);
                    logoLink.removeEventListener('mouseleave', onLeave);
                };
            });
        }

        // Toggle do menu mobile (antes era um <script> inline em header.php).
        var menuIcon = nav.querySelector('.menu-mobile');
        var menu = nav.querySelector('.menu');
        if (!menuIcon || !menu) {
            return;
        }

        var menuItems = menu.querySelectorAll('li');

        function openMenu() {
            menu.classList.add('active');
            menuIcon.setAttribute('aria-expanded', 'true');
            menuIcon.setAttribute('aria-label', 'Fechar menu');
            gsap.fromTo(
                menuItems,
                { opacity: 0, y: -10 },
                { opacity: 1, y: 0, duration: 0.35, stagger: 0.05, ease: 'power2.out' }
            );
        }

        function closeMenu() {
            menu.classList.remove('active');
            menuIcon.setAttribute('aria-expanded', 'false');
            menuIcon.setAttribute('aria-label', 'Abrir menu');
        }

        menuIcon.addEventListener('click', function () {
            if (menu.classList.contains('active')) {
                closeMenu();
            } else {
                openMenu();
            }
        });

        document.addEventListener('click', function (event) {
            if (!menu.contains(event.target) && !menuIcon.contains(event.target)) {
                closeMenu();
            }
        });
    }

    // ---------------------------------------------------------------------
    // Hero (.about)
    // ---------------------------------------------------------------------
    function initHero() {
        var hero = document.querySelector('.about');
        if (!hero) {
            return;
        }

        var coin = hero.querySelector('.content > model-viewer.desktop, .content > video.desktop, .content > img');
        var slogan = hero.querySelector('.slogan');
        var paragraph = hero.querySelector('.text p');
        var ctas = hero.querySelectorAll('.cta-group a');

        var tl = gsap.timeline({ delay: 0.9 });

        if (coin) {
            tl.from(coin, { scale: 0.6, opacity: 0, rotate: -25, duration: 1, ease: 'expo.out' });
        }
        if (slogan) {
            tl.from(slogan, { opacity: 0, y: 24, duration: 0.7, ease: 'power2.out' }, '-=0.6');
        }

        if (paragraph && !prefersReducedMotion) {
            // aria: 'none' — o padrão ("auto") põe aria-label no <p>, o que é
            // proibido pra esse elemento (o Lighthouse acusa). O texto
            // continua legível pro leitor de tela, só dividido em spans.
            var split = new SplitText(paragraph, { type: 'lines,words', linesClass: 'split-line', aria: 'none' });
            tl.from(split.words, {
                yPercent: 120,
                opacity: 0,
                duration: 0.8,
                stagger: 0.03,
                ease: 'power4.out'
            }, '-=0.35');
        } else if (paragraph) {
            tl.from(paragraph, { opacity: 0, y: 16, duration: 0.5 }, '-=0.35');
        }

        if (ctas.length) {
            var ctaRestores = Array.prototype.map.call(ctas, excludeTransformTransition);
            tl.from(ctas, {
                opacity: 0,
                y: 16,
                scale: 0.9,
                duration: 0.6,
                stagger: 0.12,
                ease: 'back.out(1.6)',
                onComplete: function () { ctaRestores.forEach(function (fn) { fn(); }); }
            }, '-=0.3');
        }

        // No mobile, o botão flutuante do WhatsApp (fixo, canto inferior
        // direito) cai bem em cima do 2º CTA do hero ("Peça seu
        // orçamento" — que já leva pro mesmo WhatsApp). Some enquanto o
        // hero estiver na tela — via classe CSS com !important (não GSAP):
        // a entrada/pulso do botão em initFooter() mexe no opacity/transform
        // dele via estilo inline (e outras coisas na página disparam
        // ScrollTrigger.refresh(), que por sua vez re-renderiza esses
        // tweens e reescreve o opacity inline por cima do que a gente seta
        // manualmente). !important garante que a classe vence de qualquer
        // jeito, então não precisa disputar com nada disso.
        var whatsapp = document.querySelector('.whatsapp-float');
        if (whatsapp && window.matchMedia(MOBILE_BREAKPOINT).matches) {
            ScrollTrigger.create({
                trigger: hero,
                // "top bottom" (não "top top"): precisa estar ativo DESDE o
                // carregamento da página (hero já visível de cara), não só
                // depois que o usuário rolar ~90px.
                start: 'top bottom',
                end: 'bottom top',
                onToggle: function (self) {
                    whatsapp.classList.toggle('is-behind-hero', self.isActive);
                }
            });
        }

        if (coin) {
            gsap.matchMedia().add(DESKTOP_BREAKPOINT, function () {
                if (prefersReducedMotion) {
                    return;
                }

                var idle = gsap.to(coin, {
                    y: -14,
                    duration: 2.6,
                    ease: 'sine.inOut',
                    yoyo: true,
                    repeat: -1,
                    paused: true
                });
                tl.eventCallback('onComplete', function () { idle.play(); });

                var parallax = gsap.to(coin, {
                    yPercent: 18,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: hero,
                        start: 'top top',
                        end: 'bottom top',
                        scrub: true
                    }
                });

                return function () {
                    idle.kill();
                    parallax.kill();
                };
            });
        }
    }

    // ---------------------------------------------------------------------
    // Clientes / parceiros
    // ---------------------------------------------------------------------
    function initClientes() {
        var section = document.querySelector('.clientes');
        if (!section) {
            return;
        }

        var track = section.querySelector('.slick-clientes');

        // Seção curta (tira estreita de logos): com o gatilho no mesmo
        // ponto das seções grandes (top 25%), o scroll normal já tira ela
        // de vista antes do reveal terminar — parece bugado/acelerado.
        // Dispara bem mais cedo (assim que começa a aparecer) e com um
        // movimento mais curto/rápido, que cabe no pouco tempo de tela que
        // uma seção curta tem.
        gsap.from(section.querySelectorAll('h2, .slick-clientes'), {
            opacity: 0,
            y: 15,
            scale: 0.98,
            duration: 0.5,
            stagger: 0.1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: section,
                start: 'top 90%',
                toggleActions: 'play none none none'
            }
        });

        // Pop de cada logo no hover. Delegado no container (não nos <li>/
        // <img> individuais) de propósito: o Slick clona slides pro loop
        // infinito (infinite:true) DEPOIS que esse script já rodou, então
        // um listener preso a um elemento específico perderia os clones —
        // delegação resolve isso de graça, o alvo é lido a cada evento.
        if (track && !prefersReducedMotion) {
            gsap.matchMedia().add(DESKTOP_BREAKPOINT + ' and (pointer: fine)', function () {
                function onOver(e) {
                    var img = e.target.closest('img');
                    if (img) {
                        gsap.to(img, { scale: 1.12, y: -4, duration: 0.3, ease: 'power2.out' });
                    }
                }
                function onOut(e) {
                    var img = e.target.closest('img');
                    if (img) {
                        gsap.to(img, { scale: 1, y: 0, duration: 0.3, ease: 'power2.out' });
                    }
                }

                track.addEventListener('mouseover', onOver);
                track.addEventListener('mouseout', onOut);

                return function () {
                    track.removeEventListener('mouseover', onOver);
                    track.removeEventListener('mouseout', onOut);
                };
            });
        }
    }

    // ---------------------------------------------------------------------
    // Serviços — stagger dos cards ao entrar na viewport
    // ---------------------------------------------------------------------
    function initServicos() {
        var section = document.querySelector('.servicos');
        if (!section) {
            return;
        }

        var heading = section.querySelector('.text h2');
        var cards = section.querySelectorAll('.lista .servico');

        // O reveal do heading fica FORA do timeline pinado, de propósito:
        // o SplitText roda antes da fonte carregar (aviso inofensivo no
        // console) e se re-divide sozinho quando ela troca — se isso
        // acontecesse dentro do timeline com pin, a mudança de altura do
        // heading bagunçava a medição do pin-spacer e travava os cards
        // no estado inicial (bug visto e confirmado durante os testes).
        if (heading && !prefersReducedMotion) {
            var split = new SplitText(heading, { type: 'lines' });
            gsap.from(split.lines, {
                opacity: 0,
                y: 40,
                duration: 0.6,
                stagger: 0.1,
                ease: 'power3.out',
                scrollTrigger: { trigger: section, start: 'top 25%', toggleActions: 'play none none none' }
            });
        } else if (heading) {
            gsap.from(heading, {
                opacity: 0,
                y: 20,
                duration: 0.5,
                scrollTrigger: { trigger: section, start: 'top 25%', toggleActions: 'play none none none' }
            });
        }

        if (!cards.length) {
            return;
        }

        var tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: 'top 25%',
                toggleActions: 'play none none none'
            }
        });

        var restoreFns = [];
        cards.forEach(function (card, i) {
            restoreFns.push(excludeTransformTransition(card));
            tl.from(card, {
                opacity: 0,
                x: i % 2 === 0 ? -60 : 60,
                duration: 0.6,
                ease: 'power3.out'
            }, i === 0 ? 0 : '-=0.45');
        });
        tl.eventCallback('onComplete', function () {
            restoreFns.forEach(function (fn) { fn(); });
        });
    }

    // ---------------------------------------------------------------------
    // Projetos — reveal em batch + tilt 3D no hover
    // ---------------------------------------------------------------------
    function initProjetos() {
        var section = document.querySelector('.posts');
        if (!section) {
            return;
        }

        // Hoje o site tem só 1-2 projetos publicados, então essa seção
        // costuma ser curta (uma linha só de cards). Com o gatilho no
        // mesmo ponto das seções grandes (top 25%), o scroll normal já
        // tira ela de vista antes do reveal terminar — parece bugado/
        // acelerado. Dispara bem mais cedo e com um movimento mais curto/
        // rápido, que cabe no pouco tempo de tela que uma seção curta tem
        // (some vira uma grade maior conforme mais projetos entram, mas o
        // ajuste continua funcionando bem nesse caso também).
        var heading = section.querySelectorAll('h2, .posts > .container > a');
        if (heading.length) {
            gsap.from(heading, {
                opacity: 0,
                y: 24,
                duration: 0.5,
                stagger: 0.1,
                ease: 'power2.out',
                scrollTrigger: { trigger: section, start: 'top 90%', toggleActions: 'play none none none' }
            });
        }

        var cards = section.querySelectorAll('.posts .post');
        if (cards.length) {
            // Sem onEnterBack/onLeaveBack: os cards entram uma vez e não
            // voltam a animar ao rolar pra cima.
            ScrollTrigger.batch(cards, {
                start: 'top 90%',
                onEnter: function (batch) {
                    gsap.from(batch, {
                        opacity: 0,
                        y: 20,
                        scale: 0.97,
                        duration: 0.5,
                        stagger: 0.1,
                        ease: 'power3.out'
                    });
                }
            });
        }

        if (!prefersReducedMotion) {
            gsap.matchMedia().add(DESKTOP_BREAKPOINT + ' and (pointer: fine)', function () {
                cards.forEach(function (card) {
                    var img = card.querySelector('img');
                    var rotateX = gsap.quickTo(card, 'rotateX', { duration: 0.4, ease: 'power2.out' });
                    var rotateY = gsap.quickTo(card, 'rotateY', { duration: 0.4, ease: 'power2.out' });
                    var scaleImg = img ? gsap.quickTo(img, 'scale', { duration: 0.4, ease: 'power2.out' }) : null;

                    function onMove(e) {
                        var rect = card.getBoundingClientRect();
                        var relX = (e.clientX - rect.left) / rect.width - 0.5;
                        var relY = (e.clientY - rect.top) / rect.height - 0.5;
                        rotateX(relY * -8);
                        rotateY(relX * 8);
                        if (scaleImg) {
                            scaleImg(1.06);
                        }
                    }

                    function onLeave() {
                        rotateX(0);
                        rotateY(0);
                        if (scaleImg) {
                            scaleImg(1);
                        }
                    }

                    gsap.set(card, { transformPerspective: 800 });
                    card.addEventListener('mousemove', onMove);
                    card.addEventListener('mouseleave', onLeave);

                    return function () {
                        card.removeEventListener('mousemove', onMove);
                        card.removeEventListener('mouseleave', onLeave);
                    };
                });
            });
        }
    }

    // ---------------------------------------------------------------------
    // Newsletter / Contato
    // ---------------------------------------------------------------------
    // "top 10%" (mais tarde que o "top 25%" do resto do site — quanto
    // MENOR a porcentagem, mais perto do topo da tela o elemento precisa
    // chegar, então mais scroll é necessário) de propósito: o formulário
    // pedia mais scroll antes de revelar, senão abria cedo demais.
    function initNewsletter() {
        var section = document.querySelector('.newsletter');
        if (!section) {
            return;
        }

        var text = section.querySelector('.text');
        var glass = section.querySelector('.glass');

        if (text) {
            gsap.from(text, {
                opacity: 0,
                x: -40,
                duration: 0.8,
                ease: 'power2.out',
                scrollTrigger: { trigger: section, start: 'top 10%', toggleActions: 'play none none none' }
            });
        }

        if (glass) {
            gsap.from(glass, {
                opacity: 0,
                x: 40,
                duration: 0.8,
                delay: 0.15,
                ease: 'power2.out',
                scrollTrigger: { trigger: section, start: 'top 10%', toggleActions: 'play none none none' }
            });

            var fields = glass.querySelectorAll('.field, fieldset, button');
            if (fields.length) {
                // Só o <button> (glow-button) tem transition no transform.
                var submitBtn = glass.querySelector('button');
                var restoreSubmit = submitBtn ? excludeTransformTransition(submitBtn) : null;
                gsap.from(fields, {
                    opacity: 0,
                    y: 16,
                    duration: 0.5,
                    stagger: 0.08,
                    ease: 'power2.out',
                    scrollTrigger: { trigger: glass, start: 'top 10%', toggleActions: 'play none none none' },
                    onComplete: function () { if (restoreSubmit) restoreSubmit(); }
                });
            }
        }

        var socialIcons = section.querySelectorAll('.text ul li');
        if (socialIcons.length) {
            gsap.from(socialIcons, {
                opacity: 0,
                scale: 0,
                duration: 0.5,
                stagger: 0.1,
                ease: 'back.out(2)',
                scrollTrigger: { trigger: section, start: 'top 10%', toggleActions: 'play none none none' }
            });
        }
    }

    // ---------------------------------------------------------------------
    // Footer
    // ---------------------------------------------------------------------
    function initFooter() {
        var footer = document.querySelector('footer');
        if (!footer) {
            return;
        }

        var card = footer.querySelector('.footer-card');
        var nav = footer.querySelectorAll('.footer-card__nav a');
        var contact = footer.querySelectorAll('.footer-card__contact > *');
        var wordmark = footer.querySelector('.footer-card__wordmark span');
        var whatsapp = document.querySelector('.whatsapp-float');

        // O footer é a última seção da página — não sobra espaço de scroll
        // depois dele pro topo do card chegar no topo da viewport (o scroll
        // acaba antes disso). "bottom bottom" (dispara quando o CARD TERMINA
        // de entrar na tela) é o equivalente aqui: sempre alcançável, e ainda
        // assim só revela quando a seção já está bem visível.
        if (card) {
            gsap.from(card, {
                opacity: 0,
                y: 40,
                duration: 0.8,
                ease: 'power2.out',
                scrollTrigger: { trigger: card, start: 'bottom bottom', toggleActions: 'play none none none' }
            });
        }

        if (nav.length) {
            gsap.from(nav, {
                opacity: 0,
                y: 16,
                duration: 0.5,
                stagger: 0.06,
                ease: 'power2.out',
                scrollTrigger: { trigger: card, start: 'bottom bottom', toggleActions: 'play none none none' }
            });
        }

        if (contact.length) {
            gsap.from(contact, {
                opacity: 0,
                y: 16,
                duration: 0.5,
                stagger: 0.06,
                ease: 'power2.out',
                scrollTrigger: { trigger: card, start: 'bottom bottom', toggleActions: 'play none none none' }
            });
        }

        if (wordmark) {
            gsap.matchMedia().add(DESKTOP_BREAKPOINT, function () {
                if (prefersReducedMotion) {
                    return;
                }

                var parallax = gsap.to(wordmark, {
                    yPercent: -12,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: card,
                        start: 'top bottom',
                        end: 'bottom bottom',
                        scrub: true
                    }
                });

                var glow = gsap.to(wordmark, {
                    opacity: 0.75,
                    duration: 2.4,
                    ease: 'sine.inOut',
                    yoyo: true,
                    repeat: -1
                });

                return function () {
                    parallax.kill();
                    glow.kill();
                };
            });
        }

        if (whatsapp) {
            // O botão anima pra sempre (pulso infinito logo abaixo), então
            // aqui a exclusão do "transform" da transition é definitiva —
            // sem restore. O hover de cor/fundo continua transicionando
            // normalmente, só o transform passa a ser 100% do GSAP.
            excludeTransformTransition(whatsapp);

            // Entrada só de "scale" (sem opacity) de propósito: um
            // botãozinho com scale:0 já é efetivamente invisível, e assim
            // o GSAP nunca chega a tocar "opacity" nesse elemento. Testado
            // e confirmado: se o GSAP alguma vez seta opacity aqui, esse
            // valor "gruda" e volta a aparecer junto de renders futuros
            // (como o pulso abaixo, que só mexe em scale) — mesmo bem
            // depois da classe que o esconde ter sido removida. Deixando
            // 100% pra classe CSS (.is-behind-hero, initHero) controlar
            // opacity, sem GSAP nunca disputar essa propriedade.
            gsap.from(whatsapp, { scale: 0, duration: 0.5, delay: 1.4, ease: 'back.out(2)' });

            if (!prefersReducedMotion) {
                gsap.to(whatsapp, {
                    scale: 1.06,
                    duration: 1.8,
                    delay: 2,
                    yoyo: true,
                    repeat: -1,
                    ease: 'sine.inOut'
                });
            }
        }
    }

    // Header e hero têm timelines de entrada (delay curto + duração
    // própria). Se rodassem já no DOMContentLoaded, tocariam escondidas
    // atrás da tela preta do preloader (header.php) e o usuário nunca veria
    // o reveal. Por isso esperam o preloader sumir pra começar — as demais
    // seções (reveal ao rolar) não têm esse problema e seguem imediatas.
    function whenPreloaderDone(fn) {
        var preloader = document.getElementById('preloader');
        if (!preloader || preloader.classList.contains('is-hidden')) {
            fn();
        } else {
            window.addEventListener('preloaderhidden', fn, { once: true });
        }
    }

    ready(function () {
        try {
            whenPreloaderDone(function () {
                try {
                    initHeader();
                    initHero();
                } catch (err) {
                    if (window.console && console.error) {
                        console.error('Erro ao iniciar as animações GSAP:', err);
                    }
                }
            });
            initClientes();
            initServicos();
            initProjetos();
            initNewsletter();
            initFooter();
        } catch (err) {
            // Uma falha em uma seção não deve travar as outras nem deixar
            // o conteúdo invisível.
            if (window.console && console.error) {
                console.error('Erro ao iniciar as animações GSAP:', err);
            }
        }

        // Importante: os ScrollTriggers acima são criados de imediato, sem
        // esperar as fontes carregarem — se a criação do pin de #servicos
        // ficasse pendurada numa Promise e o usuário já tivesse rolado a
        // página nesse meio-tempo, o pin nasceria com o scroll já passado
        // do ponto certo e travaria os cards no estado inicial (invisíveis).
        //
        // O SplitText pode rodar antes da fonte "Rethink Sans" carregar (dá
        // um aviso no console) — inofensivo, porque ele mesmo re-divide o
        // texto sozinho quando a fonte troca. Só damos um refresh no
        // ScrollTrigger depois, pra recalcular alturas caso o texto tenha
        // reformatado.
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(function () {
                ScrollTrigger.refresh();
            });
        }
        window.addEventListener('load', function () {
            ScrollTrigger.refresh();
        });
    });
})();

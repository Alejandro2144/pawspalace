@extends('layouts.app')
@section('title', __('About'))
@section('subtitle', __('About'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="about-section">
                <h2>Sobre PawsPalace</h2>
                <p>¡Bienvenido a PawsPalace! Somos una tienda en línea dedicada a productos y servicios para mascotas. Nuestro objetivo es proporcionar a los amantes de las mascotas todo lo que necesitan para cuidar, mimar y mantener felices a sus queridos compañeros peludos.</p>
            </div>
            <div class="faq-section">
                <h2>Preguntas Frecuentes</h2>
                <p>¿Tienes preguntas sobre nuestros productos o servicios? Consulta nuestras preguntas frecuentes para obtener respuestas a tus dudas más comunes.</p>
            </div>
            <div class="privacy-policy-section">
                <h2>Política de Privacidad</h2>
                <p>Nuestra política de privacidad detalla cómo recopilamos, usamos y protegemos la información personal de nuestros clientes. Tu privacidad es importante para nosotros.</p>
            </div>
            <div class="terms-conditions-section">
                <h2>Términos y Condiciones</h2>
                <p>Lee nuestros términos y condiciones para comprender tus derechos y responsabilidades al utilizar nuestro sitio web y comprar nuestros productos.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="additional-info">
                <h3>Información Adicional</h3>
                <ul>
                    <li><a href="#about-pawspalace">Sobre PawsPalace</a></li>
                    <li><a href="#faq">Preguntas Frecuentes</a></li>
                    <li><a href="#privacy-policy">Política de Privacidad</a></li>
                    <li><a href="#terms-conditions">Términos y Condiciones</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
// Crear: public/assets/js/custom/security-patches.js
"use strict";

// Patch para Bootstrap tooltips seguros
$(document).ready(function() {
    // Interceptar todas las inicializaciones de tooltip
    var originalTooltip = $.fn.tooltip;
    $.fn.tooltip = function(options) {
        var safeOptions = $.extend({}, options, {
            sanitize: true,
            whiteList: {
                'b': [],
                'strong': [],
                'i': [],
                'em': [],
                'span': ['class']
            },
            sanitizeFn: function(content) {
                // Sanitización personalizada más estricta
                return $('<div>').text(content).html();
            }
        });
        return originalTooltip.call(this, safeOptions);
    };
    
    // Patch para popovers
    var originalPopover = $.fn.popover;
    $.fn.popover = function(options) {
        var safeOptions = $.extend({}, options, {
            sanitize: true,
            whiteList: {
                'b': [],
                'strong': [],
                'i': [],
                'em': [],
                'p': [],
                'span': ['class']
            }
        });
        return originalPopover.call(this, safeOptions);
    };
    
    // Re-inicializar tooltips existentes de forma segura
    $('[data-toggle="tooltip"]').each(function() {
        $(this).tooltip('dispose').tooltip();
    });
    
    $('[data-toggle="popover"]').each(function() {
        $(this).popover('dispose').popover();
    });
});


// Agregar a security-patches.js
$(document).ready(function() {
    // Patch para carousel - validar enlaces peligrosos
    $('.carousel').on('slide.bs.carousel', function(e) {
        // Prevenir navegación a URLs peligrosas
        var trigger = $(e.relatedTarget);
        var href = trigger.attr('href');
        
        if (href && href.match(/^javascript:|^data:|^vbscript:/i)) {
            e.preventDefault();
            return false;
        }
    });
    
    // Limpiar controles de carousel existentes
    $('.carousel-control-prev, .carousel-control-next').each(function() {
        var href = $(this).attr('href');
        if (href && href.match(/^javascript:|^data:|^vbscript:/i)) {
            $(this).removeAttr('href').attr('type', 'button');
        }
    });
});


// Sanitización para inputs de Metronic
var KTSecurityUtils = function() {
    
    var sanitizeHTML = function(str) {
        var temp = document.createElement('div');
        temp.textContent = str;
        return temp.innerHTML;
    };
    
    var sanitizeAttribute = function(attr) {
        return attr.replace(/[<>"'&]/g, function(match) {
            var escape = {
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#x27;',
                '&': '&amp;'
            };
            return escape[match];
        });
    };
    
    // Patch para KTUtil
    if (typeof KTUtil !== 'undefined') {
        var originalDataGet = KTUtil.data;
        KTUtil.data = function(element) {
            var data = originalDataGet.call(this, element);
            // Sanitizar datos antes de usar
            if (typeof data === 'string') {
                return sanitizeHTML(data);
            }
            return data;
        };
    }
    
    return {
        sanitizeHTML: sanitizeHTML,
        sanitizeAttribute: sanitizeAttribute
    };
}();
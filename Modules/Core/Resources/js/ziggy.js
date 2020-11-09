    var Ziggy = {
        namedRoutes: {"api.banner.index":{"uri":"api\/v1\/frontend\/banner","methods":["GET","HEAD"],"domain":null},"api.cme.index":{"uri":"api\/v1\/frontend\/cme","methods":["GET","HEAD"],"domain":null},"api.e-learning.index":{"uri":"api\/v1\/frontend\/e-learning","methods":["GET","HEAD"],"domain":null},"api.faq.index":{"uri":"api\/v1\/frontend\/e-learning\/faq","methods":["GET","HEAD"],"domain":null},"api.product.index":{"uri":"api\/v1\/frontend\/product","methods":["GET","HEAD"],"domain":null},"api.sym-card.index":{"uri":"api\/v1\/frontend\/sym-card","methods":["GET","HEAD"],"domain":null},"api.contact-us.store":{"uri":"api\/v1\/frontend\/contact-us\/store","methods":["POST"],"domain":null},"contact-us.table":{"uri":"backend\/contact-us\/table","methods":["GET","HEAD"],"domain":null},"contact-us.data":{"uri":"backend\/contact-us\/{contact_us}\/data","methods":["GET","HEAD"],"domain":null},"update":{"uri":"backend\/contact-us\/{}","methods":["PUT","PATCH"],"domain":null},"contact-us.edit":{"uri":"backend\/contact-us\/{contact_us}\/detail","methods":["GET","HEAD"],"domain":null},"contact-us.index":{"uri":"backend\/contact-us","methods":["GET","HEAD"],"domain":null},"dashboard.index":{"uri":"backend","methods":["GET","HEAD"],"domain":null},"user.table":{"uri":"api\/backend\/kelola-user\/user\/table","methods":["GET","HEAD"],"domain":null},"user.data":{"uri":"api\/backend\/kelola-user\/user\/{user}\/data","methods":["GET","HEAD"],"domain":null},"user.store":{"uri":"api\/backend\/kelola-user\/user","methods":["POST"],"domain":null},"user.update":{"uri":"api\/backend\/kelola-user\/user\/{user}","methods":["PUT","PATCH"],"domain":null},"user.destroy":{"uri":"api\/backend\/kelola-user\/user\/{user}","methods":["DELETE"],"domain":null},"user.index":{"uri":"backend\/kelola-user\/user","methods":["GET","HEAD"],"domain":null},"user.create":{"uri":"backend\/kelola-user\/user\/tambah","methods":["GET","HEAD"],"domain":null},"user.edit":{"uri":"backend\/kelola-user\/user\/{user}\/ubah","methods":["GET","HEAD"],"domain":null},"login":{"uri":"auth\/login","methods":["GET","HEAD"],"domain":null},"post-login":{"uri":"auth\/login","methods":["POST"],"domain":null},"logout":{"uri":"auth\/logout","methods":["GET","POST","HEAD"],"domain":null},"password.request":{"uri":"auth\/password\/request","methods":["GET","HEAD"],"domain":null},"password.email":{"uri":"auth\/password\/email","methods":["POST"],"domain":null},"password.update":{"uri":"auth\/password\/reset","methods":["POST"],"domain":null},"password.reset":{"uri":"auth\/password\/reset\/{token}","methods":["GET","HEAD"],"domain":null},"faq.table":{"uri":"backend\/master-data\/faq\/table","methods":["GET","HEAD"],"domain":null},"faq.data":{"uri":"backend\/master-data\/faq\/{faq}\/data","methods":["GET","HEAD"],"domain":null},"faq.store":{"uri":"backend\/master-data\/faq","methods":["POST"],"domain":null},"faq.update":{"uri":"backend\/master-data\/faq\/{faq}","methods":["PUT","PATCH"],"domain":null},"faq.destroy":{"uri":"backend\/master-data\/faq\/{faq}","methods":["DELETE"],"domain":null},"banner.table":{"uri":"backend\/master-data\/banner\/table","methods":["GET","HEAD"],"domain":null},"banner.data":{"uri":"backend\/master-data\/banner\/{banner}\/data","methods":["GET","HEAD"],"domain":null},"banner.store":{"uri":"backend\/master-data\/banner","methods":["POST"],"domain":null},"banner.update":{"uri":"backend\/master-data\/banner\/{banner}","methods":["PUT","PATCH"],"domain":null},"banner.destroy":{"uri":"backend\/master-data\/banner\/{banner}","methods":["DELETE"],"domain":null},"cme.table":{"uri":"backend\/master-data\/cme\/table","methods":["GET","HEAD"],"domain":null},"cme.data":{"uri":"backend\/master-data\/cme\/{cme}\/data","methods":["GET","HEAD"],"domain":null},"cme.store":{"uri":"backend\/master-data\/cme","methods":["POST"],"domain":null},"cme.update":{"uri":"backend\/master-data\/cme\/{cme}","methods":["PUT","PATCH"],"domain":null},"cme.destroy":{"uri":"backend\/master-data\/cme\/{cme}","methods":["DELETE"],"domain":null},"e-learning.table":{"uri":"backend\/master-data\/e-learning\/table","methods":["GET","HEAD"],"domain":null},"e-learning.data":{"uri":"backend\/master-data\/e-learning\/{e_learning}\/data","methods":["GET","HEAD"],"domain":null},"e-learning.store":{"uri":"backend\/master-data\/e-learning","methods":["POST"],"domain":null},"e-learning.update":{"uri":"backend\/master-data\/e-learning\/{e_learning}","methods":["PUT","PATCH"],"domain":null},"e-learning.destroy":{"uri":"backend\/master-data\/e-learning\/{e_learning}","methods":["DELETE"],"domain":null},"product.table":{"uri":"backend\/master-data\/product\/table","methods":["GET","HEAD"],"domain":null},"product.data":{"uri":"backend\/master-data\/product\/{product}\/data","methods":["GET","HEAD"],"domain":null},"product.store":{"uri":"backend\/master-data\/product","methods":["POST"],"domain":null},"product.update":{"uri":"backend\/master-data\/product\/{product}","methods":["PUT","PATCH"],"domain":null},"product.destroy":{"uri":"backend\/master-data\/product\/{product}","methods":["DELETE"],"domain":null},"product-details.table":{"uri":"backend\/master-data\/product-details\/table","methods":["GET","HEAD"],"domain":null},"product-details.data":{"uri":"backend\/master-data\/product-details\/{product_detail}\/data","methods":["GET","HEAD"],"domain":null},"product-details.store":{"uri":"backend\/master-data\/product-details","methods":["POST"],"domain":null},"product-details.update":{"uri":"backend\/master-data\/product-details\/{product_detail}","methods":["PUT","PATCH"],"domain":null},"product-details.destroy":{"uri":"backend\/master-data\/product-details\/{product_detail}","methods":["DELETE"],"domain":null},"sym-card.table":{"uri":"backend\/master-data\/sym-card\/table","methods":["GET","HEAD"],"domain":null},"sym-card.data":{"uri":"backend\/master-data\/sym-card\/{sym_card}\/data","methods":["GET","HEAD"],"domain":null},"sym-card.store":{"uri":"backend\/master-data\/sym-card","methods":["POST"],"domain":null},"sym-card.update":{"uri":"backend\/master-data\/sym-card\/{sym_card}","methods":["PUT","PATCH"],"domain":null},"sym-card.destroy":{"uri":"backend\/master-data\/sym-card\/{sym_card}","methods":["DELETE"],"domain":null},"faq.index":{"uri":"backend\/master-data\/faq","methods":["GET","HEAD"],"domain":null},"faq.create":{"uri":"backend\/master-data\/faq\/tambah","methods":["GET","HEAD"],"domain":null},"faq.edit":{"uri":"backend\/master-data\/faq\/{faq}\/ubah","methods":["GET","HEAD"],"domain":null},"banner.index":{"uri":"backend\/master-data\/banner","methods":["GET","HEAD"],"domain":null},"banner.create":{"uri":"backend\/master-data\/banner\/tambah","methods":["GET","HEAD"],"domain":null},"banner.edit":{"uri":"backend\/master-data\/banner\/{banner}\/ubah","methods":["GET","HEAD"],"domain":null},"cme.index":{"uri":"backend\/master-data\/cme","methods":["GET","HEAD"],"domain":null},"cme.create":{"uri":"backend\/master-data\/cme\/tambah","methods":["GET","HEAD"],"domain":null},"cme.edit":{"uri":"backend\/master-data\/cme\/{cme}\/ubah","methods":["GET","HEAD"],"domain":null},"e-learning.index":{"uri":"backend\/master-data\/e-learning","methods":["GET","HEAD"],"domain":null},"e-learning.create":{"uri":"backend\/master-data\/e-learning\/tambah","methods":["GET","HEAD"],"domain":null},"e-learning.edit":{"uri":"backend\/master-data\/e-learning\/{e_learning}\/ubah","methods":["GET","HEAD"],"domain":null},"product.index":{"uri":"backend\/master-data\/product","methods":["GET","HEAD"],"domain":null},"product.create":{"uri":"backend\/master-data\/product\/tambah","methods":["GET","HEAD"],"domain":null},"product.edit":{"uri":"backend\/master-data\/product\/{product}\/ubah","methods":["GET","HEAD"],"domain":null},"product-details.index":{"uri":"backend\/master-data\/product-details","methods":["GET","HEAD"],"domain":null},"product-details.create":{"uri":"backend\/master-data\/product-details\/tambah","methods":["GET","HEAD"],"domain":null},"product-details.edit":{"uri":"backend\/master-data\/product-details\/{product_detail}\/ubah","methods":["GET","HEAD"],"domain":null},"sym-card.index":{"uri":"backend\/master-data\/sym-card","methods":["GET","HEAD"],"domain":null},"sym-card.create":{"uri":"backend\/master-data\/sym-card\/tambah","methods":["GET","HEAD"],"domain":null},"sym-card.edit":{"uri":"backend\/master-data\/sym-card\/{sym_card}\/ubah","methods":["GET","HEAD"],"domain":null}},
        baseUrl: 'http://ykvi.or.id/web/',
        baseProtocol: 'http',
        baseDomain: 'ykvi.or.id',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }

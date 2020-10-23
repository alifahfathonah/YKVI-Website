    var Ziggy = {
        namedRoutes: {"dashboard.index":{"uri":"\/","methods":["GET","HEAD"],"domain":null},"faq.table":{"uri":"api\/master-data\/faq\/table","methods":["GET","HEAD"],"domain":null},"faq.data":{"uri":"api\/master-data\/faq\/{faq}\/data","methods":["GET","HEAD"],"domain":null},"faq.store":{"uri":"api\/master-data\/faq","methods":["POST"],"domain":null},"faq.update":{"uri":"api\/master-data\/faq\/{faq}","methods":["PUT","PATCH"],"domain":null},"faq.destroy":{"uri":"api\/master-data\/faq\/{faq}","methods":["DELETE"],"domain":null},"banner.table":{"uri":"api\/master-data\/banner\/table","methods":["GET","HEAD"],"domain":null},"banner.data":{"uri":"api\/master-data\/banner\/{banner}\/data","methods":["GET","HEAD"],"domain":null},"banner.store":{"uri":"api\/master-data\/banner","methods":["POST"],"domain":null},"banner.update":{"uri":"api\/master-data\/banner\/{banner}","methods":["PUT","PATCH"],"domain":null},"banner.destroy":{"uri":"api\/master-data\/banner\/{banner}","methods":["DELETE"],"domain":null},"e-learning.table":{"uri":"api\/master-data\/e-learning\/table","methods":["GET","HEAD"],"domain":null},"e-learning.data":{"uri":"api\/master-data\/e-learning\/{e_learning}\/data","methods":["GET","HEAD"],"domain":null},"e-learning.store":{"uri":"api\/master-data\/e-learning","methods":["POST"],"domain":null},"e-learning.update":{"uri":"api\/master-data\/e-learning\/{e_learning}","methods":["PUT","PATCH"],"domain":null},"e-learning.destroy":{"uri":"api\/master-data\/e-learning\/{e_learning}","methods":["DELETE"],"domain":null},"faq.index":{"uri":"master-data\/faq","methods":["GET","HEAD"],"domain":null},"faq.create":{"uri":"master-data\/faq\/tambah","methods":["GET","HEAD"],"domain":null},"faq.edit":{"uri":"master-data\/faq\/{faq}\/ubah","methods":["GET","HEAD"],"domain":null},"banner.index":{"uri":"master-data\/banner","methods":["GET","HEAD"],"domain":null},"banner.create":{"uri":"master-data\/banner\/tambah","methods":["GET","HEAD"],"domain":null},"banner.edit":{"uri":"master-data\/banner\/{banner}\/ubah","methods":["GET","HEAD"],"domain":null},"e-learning.index":{"uri":"master-data\/e-learning","methods":["GET","HEAD"],"domain":null},"e-learning.create":{"uri":"master-data\/e-learning\/tambah","methods":["GET","HEAD"],"domain":null},"e-learning.edit":{"uri":"master-data\/e-learning\/{e_learning}\/ubah","methods":["GET","HEAD"],"domain":null}},
        baseUrl: 'http://ykvi-website.test/',
        baseProtocol: 'http',
        baseDomain: 'ykvi-website.test',
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

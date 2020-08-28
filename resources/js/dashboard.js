$(document).ready(function(){
        $("body").on('click','.printVoucher',function(){
            let voucher_code = $(this).closest("tr").find(".myColumn").text();
            let twoLetters = voucher_code.slice(0,2)
            let url = "{{url('/voucher/sitio/print/:id/:voucherCode')}}";
            console.log(voucher_code);
            $.get("{{route('material.getVoucher')}}" + "/" + voucher_code + "/get-voucher",function(data){
                switch(data.voucher_id){
                    case "1":
                        let maVoucer = "{{url('voucher/maintenance/print/:id/:voucherCode')}}"
                        maVoucer = maVoucer.replace(":id",1);
                        maVoucer = maVoucer.replace(':voucherCode',voucher_code)
                        window.open(maVoucer,"_self")
                        break;
                    case "2":
                        let blVoucer = "{{url('voucher/blanket/print/:id/:voucherCode')}}"
                        blVoucer = blVoucer.replace(":id",2);
                        blVoucer = blVoucer.replace(':voucherCode',voucher_code)
                        window.open(blVoucer,"_self")
                        break;
                    case "3":
                        let meVoucher = "{{url('voucher/metering/print/:id/:voucherCode')}}"
                        meVoucher = meVoucher.replace(":id",3);
                        meVoucher = meVoucher.replace(':voucherCode',voucher_code)
                        window.open(meVoucher,"_self")
                        break;
                    case "4":
                        let siVoucher = "{{url('voucher/sitio/print/:id/:voucherCode')}}"
                        siVoucher = siVoucher.replace(":id",4);
                        siVoucher = siVoucher.replace(':voucherCode',voucher_code)
                        window.open(siVoucher,"_self")
                        break;
                    case "5":
                        let prVoucher = "{{url('voucher/project/print/:id/:voucherCode')}}"
                        prVoucher = prVoucher.replace(":id",5);
                        prVoucher = prVoucher.replace(':voucherCode',voucher_code)
                        window.open(prVoucher,"_self")
                        break;
                }
            })
        })
    });
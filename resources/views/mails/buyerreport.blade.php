<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>quotation.sa</title>
</head>

<body style="margin: 0; padding: 0; font-family: Helvetica, Arial, sans-serif;">

<div
    style="background: linear-gradient(363deg, #f8ecff 0%, rgba(217, 217, 217, 0) 100%); padding: 0; overflow: hidden;">
    <table class="container" width="100%" border="0" cellspacing="0" cellpadding="0"
           style="border: 0px;max-width: 800px; margin: 0 auto;">
        <tr>
            <td align="center">
                <img src="{{ $data['infos']['en']['logo'] }}" alt="Logo" width="150"/>
            </td>
        </tr>
        <tr>
            <td>
                <p style="text-align: right;direction: rtl;">عزيزنا الشريك, {{ $data['company_name'] }}</p>
                <p style="text-align: right;direction: rtl;">نشكرك على استخدام منصة تسعيرة ونتطلع لمزيد من العمل معكم ،
                    اليك ملخص لطلبات الشراء الخاصه بكم خلال الأسبوع الماضي :</p>
                <p style="text-align: right;direction: rtl;">نتمنى لكم رحلة سعيدة.</p>
                <p style="text-align: right;direction: rtl;"><a href="https://www.quotation.sa">www.quotation.sa</a></p>

                <p>Dear partner, {{ $data['company_name'] }}</p>
                <p>We thank you for using quotation platform and we look forward to working more with you. Here is a
                    summary of your purchase orders during the past week:</p>
                <p>We wish you a happy trip</p>
                <p><a href="https://www.quotation.sa">www.quotation.sa</a></p>
            </td>
        </tr>
        <tr>
            <td>
                <hr>
                <table class="report" width="80%"
                       style="margin: auto;direction: rtl;border-collapse: collapse;width: 100%;" border="0"
                       cellspacing="0" cellpadding="0">
                    <tr>
                        <th style="border: 1px solid black;background-color: #ccc;padding: 8px;text-align: right;">رابط
                            وعنوان طلب الشراء
                        </th>
                        <th style="border: 1px solid black;background-color: #ccc;padding: 8px;text-align: right;">عدد
                            عروض الأسعار المقدمة
                        </th>
                        <th style="border: 1px solid black;background-color: #ccc;padding: 8px;text-align: right;">عدد
                            الاستفسارات على الطلب
                        </th>
                        <th style="border: 1px solid black;background-color: #ccc;padding: 8px;text-align: right;">حالة
                            الطلب
                        </th>
                        <th style="border: 1px solid black;background-color: #ccc;padding: 8px;text-align: right;">تاريخ
                            الإغلاق
                        </th>
                    </tr>
                    @foreach($data['purchase_orders'] as $key => $purchaseOrder)
                        <tr>
                            <td style="border: 1px solid black;
            padding: 8px;
            text-align: right;">{{ $purchaseOrder->title }}</td>
                            <td style="border: 1px solid black;
            padding: 8px;
            text-align: right;">{{ $purchaseOrder->published_offers_count }}</td>
                            <td style="border: 1px solid black;
            padding: 8px;
            text-align: right;">{{ $purchaseOrder->published_not_replied_inquires_count }}</td>
                            <td style="border: 1px solid black;
            padding: 8px;
            text-align: right;">{{ __('general.'.$purchaseOrder->status) }}</td>
                            <td style="border: 1px solid black;
            padding: 8px;
            text-align: right;">{{ $purchaseOrder->closes_at }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </table>
</div>

{{--<div class="footer" style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); display: flex; align-items: center; direction: ltr; width: 100vw;">--}}
{{--    <img src="{{ url('img/email-footer.svg') }}" alt="Email Footer" width="100%">--}}
{{--</div>--}}

</body>
</html>

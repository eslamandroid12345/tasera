<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>quotation.sa</title>
</head>

<body style="margin: 0; padding: 0; font-family: Helvetica, Arial, sans-serif;">

<div style="background: linear-gradient(363deg, #f8ecff 0%, rgba(217, 217, 217, 0) 100%); padding: 0; overflow: hidden;">
    <table class="container" width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 800px; margin: 0 auto;">
        <tr>
            <td align="center">
                <img src="{{ $data['infos']['en']['logo'] }}" alt="Logo" width="150"/>
            </td>
        </tr>
        <tr>
            <td>
                <p style="text-align: right;direction: rtl;">تم تسجيل مشتري جديد في منصة تسعيرة بانتظار الموافقة. رقم المشتري المرجعي: {{ $data['company']->reference_id }}</p>
{{--                <p style="text-align: right;direction: rtl;">تم تسجيل شركة جديدة من نوع مشترى في المنصة تحت اسم: {{ $data['company']->t('name') }} و تحت رقم مرجعى : {{ $data['company']->reference_id }}</p>--}}
                <p style="text-align: right;direction: rtl;">نتمنى لكم رحلة سعيدة.</p>
                <p style="text-align: right;direction: rtl;"><a href="https://www.quotation.sa">www.quotation.sa</a></p>

                <p>A new buyer has been registered on Quotation platform and is awaiting approval. Buyer's reference number: {{ $data['company']->reference_id }}</p>
                <p>We wish you a happy trip</p>
                <p><a href="https://www.quotation.sa">www.quotation.sa</a></p>
            </td>
        </tr>
        <tr>
            <td align="center">
                <img src="{{ $data['infos']['en']['logo'] }}" alt="Logo" width="150" style="margin-top: 50px;">
                <p style="text-align: center; margin-top: 50px;">
                    <a href="https://quotation.sa/about-us">من نحن</a> |
                    <a href="https://quotation.sa/terms-and-conditions">الشروط والأحكام</a> |
                    <a href="https://quotation.sa/contact-us">تواصل معنا</a> |
                    <a href="https://quotation.sa/complaints">الشكاى والاقتراحات</a> |
                    <a href="https://quotation.sa/guidance">شرح الاستخدام</a> |
                    <a href="https://quotation.sa/faqs">الأسئلة الشائعة</a>
                </p>
                <p style="text-align: center;">
                    @if($data['infos']['en']['social'] !== null)
                        @foreach($data['infos']['en']['social'] as $account)
                            <a href="{{ $account['link'] }}"><img src="{{ $account['icon'] }}" width="34" height="34" alt=""></a>
                        @endforeach
                    @endif
                </p>
            </td>
        </tr>
    </table>
</div>

<div class="footer" style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); display: flex; align-items: center; direction: ltr; width: 100vw;">
    <img src="{{ url('img/email-footer.svg') }}" alt="Email Footer" width="100%">
</div>

</body>
</html>

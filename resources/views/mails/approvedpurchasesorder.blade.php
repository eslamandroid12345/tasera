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
                <p style="text-align: right;direction: rtl;">عزيزنا الشريك, {{ $data['user']->company->t('name') }}</p>
                <p style="text-align: right;direction: rtl;">نفيدكم بان عرض السعر الخاص بكم رقم {{ $data['reference_id'] }} على طلب الشراء رقم {{ $data['purchases_order'] }} تم تعميده من قبل المشتري ({{ $data['buyer']->t('name') }} )</p>
                <p style="text-align: right;direction: rtl;">نتمنى لكم رحلة سعيدة.</p>
                <p style="text-align: right;direction: rtl;">تفضل بزيارة صفحة طلب الشراء : <a href="{{ env('purchase_orders').$data['purchases_order'] }}">{{ env('purchase_orders').$data['purchases_order'] }}</a></p>

                <p>Dear partner, {{ $data['user']->company->t('name') }}</p>
                <p>We inform you that your price quote No. {{ $data['reference_id'] }} on purchase order No. {{ $data['purchases_order'] }} has been approved by the buyer ({{ $data['buyer']->t('name') }})</p>
                <p>We wish you a happy trip</p>
                <p>Visit the purchase request page: <a href="{{ env('purchase_orders').$data['purchases_order'] }}">{{ env('purchase_orders').$data['purchases_order'] }}</a></p>
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

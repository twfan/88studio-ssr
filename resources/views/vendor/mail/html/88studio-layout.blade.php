<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{{ config('app.name') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<script src="https://cdn.tailwindcss.com"></script>
<style>
@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
color: white !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}
</style>
</head>
<body>
    <div class="flex flex-col items-center justify-center">
        <div class="flex w-3/4 bg-blue-500">
            <table>
                <tr class="border">
                    <td class="border">1</td>
                    <td class="border">
                        test
                    </td>
                    <td class="border">2</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>

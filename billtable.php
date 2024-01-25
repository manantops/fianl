<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
    .address {
        position: absolute;
        top: 150px;
        font-size: x-large;
        font-family: 'Times New Roman', Times, serif;
    }

    .city {
        font-weight: 900;
        font-family: 'Times New Roman', Times, serif;
    }

    .fa-brands {
        color: green;
    }

    .fa-solid {
        color: rgb(0, 0, 0);
    }
</style>

<body>
    <a href="#">
        <i class="fa-brands fa-whatsapp fa-2xl"></i>
    </a>

    <a href="#">
        <i class="fa-solid fa-print fa-2xl" onclick="print()"></i>

    </a>



    <br>

    <center>
        <table border="2" cellspacing="0" cellpadding="10" style="width: 800px; height: 800PX;">
            <tr>
                <th colspan="2">
                    J.S SHAH
                    <br>
                    TAX CONSULTANT
                    <br>
                    MAIN ROAD , SURENDRANAGAR- 363 001
                    <br>
                    PHONE : (02752) 223437
                </th>

            </tr>
            <tr>
                <td rowspan="2" style="height: 100px;">
                    <P style="position: absolute; top: 140PX;">TO ,</P>

                    <pre id="address" class="address"></pre>


                </td>
                <th>CLIENT CODE :
                    <p id="clientcode"></p>
                </th>
            </tr>
            <tr>

                <th>MEMO NO
                    <p id="memo"></p>
                </th>
            </tr>
            <tr>
                <td>

                    <b> CITY</b>
                    <p id="city" class="city"></p>
                </td>

                <th>DATE
                    <p id="date"> </p>
                </th>
            </tr>
            <tr>
                <th>PARTICULAR</th>
                <th>AMOUNT RS.</th>
            </tr>
            <tr>
                <td> <b> BEING PROFESSIONAL CHARGES FOR : </b>
                    <b>
                        <P id="abc"></P>
                    </b>
                </td>
                <th>
                    <p id="amount"></p>
                </th>
            </tr>
            <tr>
                <th>
                    <span style="float: right;">TOTAL RS.</span>
                </th>
                <th>
                    <p id="amountt"></p>
                </th>
            </tr>
            <tr>
                <th>
                    <span style="float: right;">ADD : SERVICE TAX @ 0.00%</span>
                </th>
                <th>NILL</th>
            </tr>
            <tr>
                <th><span style="float: right;">GRAND TOTAL</span></th>
                <th id="amounttt"></th>
            </tr>

            <tr>
                <td colspan="2">IN WORDS :
                  <b> <span id="inwords"></span></b> 
                </td>

            </tr>

            <tr>
                <td colspan="2">
                    **Subject to surendranagar jurisdiction
                    <br>
                    **E. & O.E.
                    <br>
                    <br>
                    <b>BANK DETAILS</b>
                    <br>
                    <B>NAME : - </B>
                    <br>
                    <b>ACCOUNT NO : -</b>
                    <br>
                    <B>IFSC CODE : - </B>
                </td>
            </tr>
        </table>
    </center>

    <script>
        var data = window.location.search;
        var params = new URLSearchParams(data);

        var clientcode = params.get("clientcode");
        var date = params.get("date");
        var memo = params.get("memo");
        var address = params.get("address");
        var city = params.get("city");
        var abc = params.get("abc");
        var amount = params.get("amount");

        var getData = clientcode;
        var getData1 = date;
        var getData2 = memo;
        var getData3 = address;
        var getData4 = city;
        var getData5 = abc;
        var getData6 = amount;


        document.getElementById("clientcode").innerHTML = getData;
        document.getElementById("date").innerHTML = getData1;
        document.getElementById("memo").innerHTML = getData2;
        document.getElementById("address").innerHTML = getData3;
        document.getElementById("city").innerHTML = getData4;
        document.getElementById("abc").innerHTML = getData5;
        document.getElementById("amount").innerHTML = getData6;
        document.getElementById("amountt").innerHTML = getData6;
        document.getElementById("amounttt").innerHTML = getData6;





        function numToWords(number) {

            if (typeof number === 'string') {
                number = parseInt(number, 10);
            }
            if (typeof number === 'number' && isFinite(number)) {
                number = number.toString(10);
            } else {
                return 'This is not a valid number';
            }

            var digits = number.split('');
            while (digits.length % 3 !== 0) {
                digits.unshift('0');
            }

            var digitsGroup = [];
            var numberOfGroups = digits.length / 3;
            for (var i = 0; i < numberOfGroups; i++) {
                digitsGroup[i] = digits.splice(0, 3);
            }

            var digitsGroupLen = digitsGroup.length;
            var numTxt = [
                [null, 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'], //hundreds
                [null, 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety' , 'Hundread'], //tens
                [null, 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'] //ones
            ];
            var tenthsDifferent = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'seventeen', 'eighteen', 'nineteen'];

            for (var j = 0; j < digitsGroupLen; j++) {
                for (var k = 0; k < 3; k++) {
                    var currentValue = digitsGroup[j][k];
                    digitsGroup[j][k] = numTxt[k][currentValue];
                    if (k === 0 && currentValue !== '0') { // !==0 avoids creating a string "null hundred"
                        digitsGroup[j][k] += ' Hundread ';
                    } else if (k === 1 && currentValue === '1') { //Changes the value in the tens place and erases the value in the ones place
                        digitsGroup[j][k] = tenthsDifferent[digitsGroup[j][2]];
                        digitsGroup[j][2] = 0; //Sets to null. Because it sets the next k to be evaluated, setting this to null doesn't work.
                    }
                }
            }

            for (var l = 0; l < digitsGroupLen; l++) {
                if (digitsGroup[l][1] && digitsGroup[l][2]) {
                    digitsGroup[l][1] += '-';
                }
                digitsGroup[l].filter(function (e) { return e !== null });
                digitsGroup[l] = digitsGroup[l].join('');
            }

            var posfix = [null, 'Thousand' , 'lakh' , 'Million', 'Billion', 'Trillion', 'Quadrillion', 'Quintillion', 'Sextillion'];
            if (digitsGroupLen > 1) {
                var posfixRange = posfix.splice(0, digitsGroupLen).reverse();
                for (var m = 0; m < digitsGroupLen - 1; m++) { //'-1' prevents adding a null posfix to the last group
                    if (digitsGroup[m]) {
                        digitsGroup[m] += ' ' + posfixRange[m];
                    }
                }
            }
            return digitsGroup.join(' ');
        }
        
        document.getElementById("inwords").innerHTML = numToWords(amount)  + " Only";
    </script>
</body>

</html>
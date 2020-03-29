
/**
 * Creates changing clock
 * @link    https://www.ricocheting.com/code/javascript/html-generator/date-time-clock
 * @author  Kilian Domaratius
 */
function setClock(){
    let d = new Date();
    let nHour = d.getHours(), nMin = d.getMinutes(), nSec = d.getSeconds();

    if(nMin <= 9) nMin = "0" + nMin;
    if(nSec <= 9) nSec = "0" + nSec;

    document.getElementById('clockDiv').innerHTML = "<span id='hour'>" + nHour + "</span>"
        + "<span id='clockDivider-1'>:</span>"
        + "<span id='minute'>" + nMin + "</span>"
        + "<span id='clockDivider-2'>:</span>"
        + "<span id='second'>" + nSec + "</span>";
}


/**
 * Creates changing date
 * @link    https://www.ricocheting.com/code/javascript/html-generator/date-time-clock
 * @author  Kilian Domaratius
 */
function setDate() {
    let d = new Date();
    let nDay = d.getDay(), nMonth = d.getMonth(), nDate = d.getDate(), nYear = d.getFullYear();

    let tDay = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    let tMonth = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    document.getElementById('dateDiv').innerHTML = "<span id='date'>"
        + "<span id='weekday'>" + tDay[nDay] + "</span>"
        + "<span id='dateDivider-1'>, </span>"
        + "<span id='month'>" + tMonth[nMonth] + "</span>"
        + "<span id='dateDivider-2'> </span>"
        + "<span id='day'>" + nDate + "</span>"
        + "<span id='dateDivider-3'>, </span>"
        + "<span id='year'>" + nYear + "</span>";
}


/**
 * Creates custom dark mode
 * @link    https://darkmodejs.learn.uno/
 * @author  Kilian Domaratius
 */
function customDarkMode() {
    $('.no-darkmode').each(function(index) {
        let zIndex = index + 500;
        $(this).css('zIndex', zIndex);
    });

    let options = {
        bottom: '72px', // default: '32px'
        right: '32px', // default: '32px'
        left: 'unset', // default: 'unset'
        time: '0.3s', // default: '0.3s'
        mixColor: '#fff', // default: '#fff'
        backgroundColor: '#fff',  // default: '#fff'
        buttonColorDark: '#100f2c',  // default: '#100f2c'
        buttonColorLight: '#fff', // default: '#fff'
        saveInCookies: true, // default: true,
        label: '🌓', // default: ''
        autoMatchOsTheme: true // default: true
    };

    const darkmode = new Darkmode(options);
    darkmode.showWidget();
}


/**
 * Send ajax to update feed
 *
 * @author Kilian Domaratius
 *
 * @param feedType
 */
function updateFeed(feedType) {
    $("#spinner-" + feedType).addClass("fa-spin");

    $.ajax({
        url: "./phpFunctions/ajax_updateFeed.php",
        data: { feedType: feedType },
        method: "POST"
    })
        .done(function( html ) {
            let updateDate = new Date;
            let updateTime = updateDate.getHours() + ":" + addZero(updateDate.getMinutes());

            //update feed and time
            $( "#feed-" + feedType + "-inner" ).html( html );
            $( "#feed-" + feedType + "-updateTime" ).html( updateTime );

            //show updating state on spinner icon
            setTimeout( function f () {
                $("#spinner-" + feedType).removeClass("fa-spin")
            } , 900);

            //log updated feed
            console.log(updateTime + " updated feed " + feedType);
        });
}



/**
 * Adding zero to time if necessary
 * e.g. 9 -> 09; 25 -> 25
 *
 * @link https://www.w3schools.com/jsref/jsref_getminutes.asp
 * @author Kilian Domaratius
 *
 * @param i
 * @return string
 */
function addZero(i) {
    i = parseInt(i);
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}


/**
 * Update every displayed feed
 *
 * @author Kilian Domaratius
 */
function updateAllFeeds() {
    $('.feed-update').click();
}


/**
 * @link https://html-online.com/articles/cookie-warning-widget-with-javascript/
 * @return null|string
 */
function GetCookie(name) {
    let arg=name+"=";
    let alen=arg.length;
    let clen=document.cookie.length;
    let i=0;
    while (i<clen) {
        let j=i+alen;
        if (document.cookie.substring(i,j)===arg)
            return "here";
        i=document.cookie.indexOf(" ",i)+1;
        if (i===0) break;
    }
    return null;
}


/**
 * @link https://html-online.com/articles/cookie-warning-widget-with-javascript/
 */
function testFirstCookie(){
    let offset = new Date().getTimezoneOffset();
    if ((offset >= -180) && (offset <= 0)) { // European time zones
        let visit=GetCookie("cookieCompliancyAccepted");
        if (visit==null){
            $("#myCookieConsent").fadeIn(400);	// Show warning
        } else {
            // Already accepted
        }
    }
}


/**
 * @link https://html-online.com/articles/cookie-warning-widget-with-javascript/
 */
function initCookieHint() {
    $("#cookieButton").click(function(){
        console.log('Understood');
        let expire=new Date();
        expire=new Date(expire.getTime()+7776000000);
        document.cookie="cookieCompliancyAccepted=here; expires="+expire+";path=/";
        $("#myCookieConsent").hide(400);
    });
    testFirstCookie();
}


/**
 * Code to run when the document is ready.
 * @link    https://learn.jquery.com/using-jquery-core/document-ready/
 * @author  Kilian Domaratius
 * @param   jQuery
 */
function readyFn( jQuery ) {
    //Code to run when the document is ready.

    //init cookie hint
    initCookieHint();

    //set time
    setClock();
    setInterval(setClock,1000);

    //set date
    setDate();
    setInterval(setDate,1000);

    //set dark mode
    customDarkMode();

    //auto reload feeds
    (function(){
        updateAllFeeds();
        setTimeout(arguments.callee, 60*60*1000);
    })();
}


$( document ).ready( readyFn );
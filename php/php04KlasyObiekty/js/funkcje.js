/* 
 Przydatne funkcje do przeprowadzenia zajęć
 */

function addEvent(o, zdarzenie, funkcja) {
    if (o.addEventListener) {
        o.addEventListener(zdarzenie, funkcja, false);
    } else if (o.attachEvent) {
        o.attachEvent("on" + zdarzenie, funkcja);
    } else {
        eval(o + ".on" + zdarzenie + "=" + funkcja + ";");
    }
}

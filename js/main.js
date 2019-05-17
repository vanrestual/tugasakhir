$(document).ready(function () {
    var pathName = window.location.pathname;
    $('.navbar-nav .nav-item').removeClass('active');
    $('.navbar-nav .nav-item a[href="' + pathName + '"]').parent().addClass('active');
    $('.navbar-nav .nav-item a').filter(function () {
        return this.pathname == pathName;
    }).parent().addClass('active');

    var lastPeriod = "Period Of " + $('.table.table-hover tbody tr:last-of-type td:nth-child(2)').html();
    var lastForecasting = $('.table.table-hover tbody tr:last-of-type td:nth-child(4)').html();
    lastForecasting = Math.ceil(lastForecasting.replace(',', ''));
    $('.table.table-hover tbody tr:last-of-type').addClass('bg-primary text-light font-weight-bold');
    $('#lastForecasting').html(lastForecasting);
    $('#lastPeriod').html(lastPeriod);
});
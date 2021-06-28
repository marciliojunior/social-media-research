require('animate.css');
import bootbox from 'bootbox';

class DialogWindow
{
    dialog(type, icon, caption, title, message, buttons, callback)
    {
        const ico = '<i class="' + icon + '">&nbsp;</i>'

        const config = {
            title: '<span class="' + caption + '">' + ico + title + '</span>',
            message: message,
            onEscape: false,
            callback: callback,
            centerVertical: true,
            className: 'animate__animated animate__zoomIn'
        };

        if(buttons)
            config.buttons = buttons;

        if(type === 'alert')
            bootbox.dialog(config).on('hidden.bs.modal', function(){ if(callback) callback(); });
        else
            bootbox.confirm(config);
    }

    alert(message, callback, title = 'Atenção')
    {
        const buttons = {
            ok: {
                label: 'Ok',
                className: 'btn-warning'
            }
        };
        this.dialog('alert', 'fas fa-exclamation-triangle', 'text-warning', title, message, buttons, callback);
    }

    error(message, callback, title = 'Erro')
    {
        const buttons = {
            ok: {
                label: 'Ok',
                className: 'btn-danger'
            }
        };
        this.dialog('alert', 'fas fa-times', 'text-danger', title, message, buttons, callback);
    }

    success(message, callback, title = 'Sucesso')
    {
        const buttons = {
            ok: {
                label: 'Ok',
                className: 'btn-success'
            }
        };
        this.dialog('alert', 'fas fa-check', 'text-success', title, message, buttons, callback);
    }

    confirm(message, title, callback)
    {
        const buttons = {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        };
        this.dialog('confirm', 'fas fa-question-circle', 'text-primary', title, message, buttons, callback);
    }

    dialogOneButton(message, title, callback, button_text = 'ok')
    {
        const buttons = {
            ok: {
                label: button_text,
                className: 'btn-success',
                callback: callback
            }
        };
        this.dialog('alert', 'fas fa-check', 'text-success', title, message, buttons);
    }
}
const dialog = new DialogWindow();
export default dialog;

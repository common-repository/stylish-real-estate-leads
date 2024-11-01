const tooltipTriggerList = document.querySelectorAll('[data-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
jQuery(document).ready(function($){
    $('.srel-color-field').wpColorPicker();

});
document.addEventListener('DOMContentLoaded', function() {
    disableGlobalSettingsSection();
    const needLicenseKeyTooltip = `You need to purchase a <a href="https://stylishcostcalculator.com/" target="_blank">premium license</a> to use this feature.`
    document.querySelectorAll('.use-premium-tooltip').forEach(node => {
        let tooltipImageUrl = node.getAttribute('data-tooltip-image');
        let tooltipStr = needLicenseKeyTooltip;
        if (tooltipImageUrl) {
            tooltipStr = `<p class="mt-3">${needLicenseKeyTooltip}</p>` + '<img class="mx-3" src=\'' + tooltipImageUrl + '\'/>';
        }
        new bootstrap.Tooltip(node, {
            delay: { show: 600, hide: 300 },
            trigger: 'hover focus',
            html: true,
            title: tooltipStr,
            placement: 'right',
            customClass: tooltipImageUrl ? 'tooltip-img-dark' : ''
        })
    })
    var mediaUploader;
    document.querySelectorAll('.upload-btn').forEach(item => {
        item?.addEventListener('click', (e) => {
            e.preventDefault();
            var id = item.getAttribute('data-id')
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media({
                title: 'Upload a file',
                button: {
                    text: 'Use this file',
                },
                multiple: false
            });

            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                document.getElementById(id).value = attachment.url;
            });

            mediaUploader.open();
        });

    });
    document.getElementById("settings")?.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        const formData = new FormData(event.target);
        const jsonData = {};
        for (let [key, value] of formData.entries()) {
            if (key.includes('[')) { // Check if the key follows the nested JSON structure
                const keys = key.split('[').map(k => k.replace(']', '')); // Split nested keys by "[" and remove "]"

                let tempObj = jsonData;
                for (let i = 0; i < keys.length - 1; i++) {
                    const currentKey = keys[i];
                    tempObj[currentKey] = tempObj[currentKey] || {};
                    tempObj = tempObj[currentKey];
                }

                const lastKey = keys[keys.length - 1];
                tempObj[lastKey] = value;
            } else {
                jsonData[key] = value; // For simple key-value pairs, directly assign the value to the key
            }
        }
        jsonData['realtor_footer_message'] = wp.editor.getContent('realtor_footer_message');
        jsonData['email_body'] = wp.editor.getContent('email_body');
        jsonData['email_heading'] = wp.editor.getContent('email_heading');
        // Display the resulting JSON object
        var submitBtn = jQuery('#srel-save-settings');
        let text = submitBtn.text();
        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: "srel_save_settings",
                nonce: pageSettings.nonce,
                data: jsonData,
                calcId:getCalcId()
            },
            beforeSend: function(xhr) {
                submitBtn.html( '<i class="fa fa-spinner fa-spin loading"></i>'+text );
                jQuery(this).prop("disabled", true);
            },
            success: function(data) {
                submitBtn.html( '<i class="fa fa-check"></i>' + text );
                window.location.reload();
                jQuery(this).prop("disabled", false);
            }
        })

    });
    document.querySelectorAll('.tooltip-inner').forEach(element => {
        element.style.maxWidth = '250px';
    });
});
function getCalcId() {
    const urlParams = new URLSearchParams(window.location.search);
    const calcId = urlParams.get("id");
    return calcId;
}
function disableGlobalSettingsSection() {
    let param = new URLSearchParams(window.location.search)
    if (param.get('page') != 'srel-settings-page') return
    let u = "https://stylishrealestateleads.com/" + '?utm_source=inside-plugin&utm_medium=wordpress&utm_content=buy-premium-cta-banner'
    var arr = document.querySelectorAll(".disabled-overlay");
    let style = {
        "background-color": "rgba(0,0,0,0.28)",
        "position": "absolute",
        "width": "100%",
        "height": "100%",
        "top": "0",
        "left": "0",
        "right": "0",
        "bottom": "0",
        "z-index": "100",
        "display": "flex",
        "align-items": "center",
        "justify-content": "end",
        "backdrop-filter": "blur(1px)",
        "padding-right": "30px"
    }
    arr.forEach((e,element) => {
        let frag = document.createDocumentFragment()
        let content = document.createElement('div')
        let div = document.createElement('div')
        Object.assign(content.style, style)
        let text = document.createElement('h5')
        text.style.color = '#000'
        text.style.textAlign = 'center'
        text.style.maxWidth = '200px'
        text.style.marginBottom = '40px'
        text.style.fontWeight = '700'
        text.innerText = 'Upgrade to unlock this setting'
        let link_cont = document.createElement('center')
        let link = document.createElement('a')
        link.style.padding = '10px'
        link.classList.add('highlighted')
        link_cont.appendChild(link)
        link.setAttribute('target', '_blank')
        link.setAttribute('href', u)
        link.innerText = 'Buy Premium'
        link.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> <span style="margin-left:5px">Buy Premium</span>'
        div.appendChild(text)
        div.appendChild(link_cont)
        content.appendChild(div)
        frag.appendChild(content)
        e.appendChild(frag)
    });
}
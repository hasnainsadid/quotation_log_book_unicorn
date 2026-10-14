<div id="template-customizer" class="card rounded-0" style="visibility: visible"> <a href="javascript:void(0)"
        class="template-customizer-open-btn" tabindex="-1"></a>
    <div class="p-6 m-0 lh-1 border-bottom template-customizer-header position-relative py-4">
        <h6 class="template-customizer-t-panel_header mb-1">Template Customizer</h6>
        <p class="template-customizer-t-panel_sub_header mb-0 small">Customize and preview in real time</p>
        <div class="d-flex align-items-center gap-2 position-absolute end-0 top-0 mt-6 me-5"> <a
                href="javascript:void(0)" class="template-customizer-reset-btn text-heading" data-bs-toggle="tooltip"
                data-bs-placement="bottom" title="Reset Customizer"><i
                    class="icon-base ti tabler-refresh icon-lg"></i><span
                    class="badge rounded-pill bg-danger badge-dot badge-notifications d-none"></span></a> <a
                href="javascript:void(0)" class="template-customizer-close-btn fw-light text-heading" tabindex="-1">
                <i class="icon-base ti tabler-x icon-lg"></i> </a> </div>
    </div>
    <div class="template-customizer-inner pt-6">
        <div class="template-customizer-theming">
            <h5 class="m-0 px-6 pb-6"> <span
                    class="template-customizer-t-theming_header bg-label-primary rounded-1 py-1 px-3 small">Theming</span>
            </h5>
            <div class="m-0 px-6 pb-6 template-customizer-color w-100"> <label for="customizerColor"
                    class="form-label d-block template-customizer-t-color_label mb-2">Primary Color</label>
                <div class="row template-customizer-colors-options">
                    <div class="form-check custom-option custom-option-icon mb-0"><label
                            class="form-check-label custom-option-content" for="colorRadioIcon">
                            <div class="pickr">

                                <button type="button" class="pcr-button ti tabler-color-picker" role="button"
                                    aria-label="toggle color picker dialog"
                                    style="transition: none; --pcr-color: rgba(255, 73, 97, 1);"></button>
                            </div>
                        </label><input name="colorRadioIcon" class="form-check-input picker d-none" type="radio"
                            value="picker" id="colorRadioIcon">
                    </div>
                </div>
            </div>
            <div class="m-0 px-6 pb-6 template-customizer-theme w-100"> <label for="customizerTheme"
                    class="form-label d-block template-customizer-t-theme_label mb-2">Theme</label>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                    <li>
                        <button type="button" class="dropdown-item align-items-center waves-effect active"
                            data-bs-theme-value="light" aria-pressed="true">
                            <span><i class="icon-base ti tabler-sun icon-22px me-3" data-icon="sun"></i>Light</span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item align-items-center waves-effect"
                            data-bs-theme-value="dark" aria-pressed="false">
                            <span><i class="icon-base ti tabler-moon-stars icon-22px me-3"
                                    data-icon="moon-stars"></i>Dark</span>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item align-items-center waves-effect"
                            data-bs-theme-value="system" aria-pressed="false">
                            <span><i class="icon-base ti tabler-device-desktop-analytics icon-22px me-3"
                                    data-icon="device-desktop-analytics"></i>System</span>
                        </button>
                    </li>
                </ul>
            </div>

            <div class="m-0 px-6 template-customizer-semiDark w-100 d-flex justify-content-between pe-12"> <span
                    class="form-label template-customizer-t-semiDark_label">Semi Dark</span> <label
                    class="switch template-customizer-t-semiDark_label"> <input type="checkbox"
                        class="template-customizer-semi-dark-switch switch-input"> <span class="switch-toggle-slider">
                        <span class="switch-on"></span> <span class="switch-off"></span> </span> </label>
            </div>
            <hr class="m-0 px-6 my-6">
        </div>
    </div>
</div>
<div class="pcr-app " data-theme="nano" aria-label="color picker dialog" role="window" style="left: 0px; top: 8px;">
    <div class="pcr-selection">
        <div class="pcr-color-preview">
            <button type="button" class="pcr-last-color" aria-label="use previous color"
                style="transition: none; --pcr-color: rgba(255, 73, 97, 1);"></button>
            <div class="pcr-current-color" style="--pcr-color: rgba(255, 73, 97, 1);"></div>
        </div>

        <div class="pcr-color-palette">
            <div class="pcr-picker"
                style="left: calc(71.3725% - 9px); top: calc(0% - 9px); background: rgb(255, 73, 97);"></div>
            <div class="pcr-palette" tabindex="0" aria-label="color selection area" role="listbox"
                style="background: linear-gradient(to top, rgb(0, 0, 0), transparent), linear-gradient(to left, rgb(255, 0, 34), rgb(255, 255, 255));">
            </div>
        </div>

        <div class="pcr-color-chooser">
            <div class="pcr-picker" style="left: calc(97.8022% - 9px); background-color: rgb(255, 0, 34);">
            </div>
            <div class="pcr-hue pcr-slider" tabindex="0" aria-label="hue selection slider" role="slider">
            </div>
        </div>

        <div class="pcr-color-opacity" style="display:none" hidden="">
            <div class="pcr-picker"></div>
            <div class="pcr-opacity pcr-slider" tabindex="0" aria-label="selection slider" role="slider">
            </div>
        </div>
    </div>

    <div class="pcr-swatches "></div>

    <div class="pcr-interaction">
        <input class="pcr-result" type="text" spellcheck="false" aria-label="color input field">

        <input class="pcr-type active" data-type="HEXA" value="HEXA" type="button" style="display:none"
            hidden="">
        <input class="pcr-type" data-type="RGBA" value="RGBA" type="button" style="display:none"
            hidden="">
        <input class="pcr-type" data-type="HSLA" value="HSLA" type="button" style="display:none"
            hidden="">
        <input class="pcr-type" data-type="HSVA" value="HSVA" type="button" style="display:none"
            hidden="">
        <input class="pcr-type" data-type="CMYK" value="CMYK" type="button" style="display:none"
            hidden="">

        <input class="pcr-save" value="Save" type="button" style="display:none" hidden=""
            aria-label="save and close">
        <input class="pcr-cancel" value="Cancel" type="button" style="display:none" hidden=""
            aria-label="cancel and close">
        <input class="pcr-clear" value="Clear" type="button" style="display:none" hidden=""
            aria-label="clear and close">
    </div>
</div>

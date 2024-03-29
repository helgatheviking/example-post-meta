/**
 * External Dependencies
 */
import { TextControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { registerPlugin } from '@wordpress/plugins';
import { __ } from "@wordpress/i18n";

const ExampleMetaPanel = (props) => {

    const { getCurrentPostType } = useSelect('core/editor');

    const postType = getCurrentPostType();

    // If no post type is selected (for example, if in Site Editor), return null.
    if ( ! postType ) {
        return null;
    }

    const [meta, setMeta] = useEntityProp('postType', postType, 'meta');
    const metaValue = meta?.your_meta_key || '';

    const updateYourMeta = (newValue) => {
        setMeta({ ...meta, your_meta_key: newValue });
    };
    
    return (
        <PluginDocumentSettingPanel
            name="example-post-meta-panel"
            title={__("Your Meta Field", "example-post-meta")}
            className="example-post-meta-panel"
        >
            <TextControl
                value={metaValue}
                onChange={updateYourMeta}
            />
        </PluginDocumentSettingPanel>
    );
}

registerPlugin( 'example-post-meta', {
	render: ExampleMetaPanel,
	icon: 'edit',
} );


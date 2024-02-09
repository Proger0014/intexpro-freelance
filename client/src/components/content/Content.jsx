import { Paper } from "@mantine/core";
import c from "./content.module.scss";

function Content({ children, ...props }) {
    return (
        <Paper px={20} py={20} radius="lg" withBorder className={c.content} {...props} >
            {children}
        </Paper>
    )
}

export default Content;
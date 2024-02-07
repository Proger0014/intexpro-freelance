import { Paper } from "@mantine/core";
import c from "./content.module.scss";

function Content({ children }) {
    return (
        <Paper px={20} py={20} radius="lg" withBorder className={c.content}>
            {children}
        </Paper>
    )
}

export default Content;
import { Box, Grid, Group, Image } from "@mantine/core";
import { Link } from "react-router-dom";
import c from "./header.module.scss";
import { Buttons } from "./buttons";
import HeaderSearch from "./HeaderSearch";

function Header({ children, isTransparent = false, logoSize = 80, ...props }) {
  const bg = isTransparent ? "0" : "indigo.9"

  return (
    <Box px="20px" py="10px" bg={bg} {...props} className={c.header}>
      <Grid justify="space-between" align="center">
        <Grid.Col span={0}>
          {/* logo */}
          <div>
            <Link
              to="/">
              <Image
                h={logoSize}
                src="/src/assets/common/logo.png" />
            </Link>
          </div>
        </Grid.Col>
        <Grid.Col span={3}>
          {children}
        </Grid.Col>
        <Grid.Col span={2} >
          <Group justify="end">
            <Buttons />
          </Group>
        </Grid.Col>
      </Grid>
    </Box>
  )
}

Header.Search = HeaderSearch;

export default Header;